<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyPaymentIntegration;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\LeaseFrequency;
use App\Models\LeaseRenewal;
use App\Models\Property;
use App\Models\PropertyLease;
use App\Models\Receipt;
use App\Models\ScheduleLease;
use App\Models\Subscription;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller{

    public function __construct(){

        $this->receipt = new Receipt();
        $this->property = new Property();
        $this->tenant = new Tenant();
        $this->leasefrequency = new LeaseFrequency();
        $this->leaserenewal = new LeaseRenewal();
        $this->invoice = new Invoice();
        $this->invoiceitem = new InvoiceItem();
        $this->companypaymentintegration = new CompanyPaymentIntegration();
        $this->subscription = new Subscription();
        $this->user = new User();
        $this->company = new Company();

    }

    /*
     * process online payment
     */
    public function onlinePayment($slug){
        $invoice = $this->invoice->getInvoice($slug);
        if(!empty($invoice)){
            $company_payment_int = $this->companypaymentintegration->getCompanyPaymentIntegration($invoice->company_id);
            if(!empty($company_payment_int)){
                #Public key
                $this->setEnv('PAYSTACK_PUBLIC_KEY', $company_payment_int->ps_public_key);
                #Secret key
                $this->setEnv('PAYSTACK_SECRET_KEY', $company_payment_int->ps_secret_key);
                return view('manager.accounting.invoice.online-payment',['invoice'=>$invoice]);
            }else{
                session()->flash("error", "<h3 class='text-center'>Whoops! Kindly contact Admin. Something went wrong.</h3> ");
                return back();
            }

        }else{
            abort(404, 'Resource not found.');
        }
    }
    private function setEnv($key, $value)
    {
        $current_value = env($key);
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '='.$current_value,
            $key .'='.$value,
            file_get_contents(app()->environmentFilePath())
        ));
    }
    public function validateSubscription(Request $request){

        $this->validate($request,[
            'no_of_units'=>'required|min:1',
            'plan_duration'=>'required',
            //'metadata.*'=>'required',
            'amount'=>'required',
            'reference'=>'required',
            'currency'=>'required'
        ],[
            'amount.required'=>'Whoops! An amount is needed to process this transaction.',
            'no_of_units.required'=>'Enter number of units ',
            'no_of_units.min'=>'A minimum of one (1) unit is needed to process this transaction'
        ]);
        $metadata = [
            'method'=>'online',
            'plan'=>$request->pl,
            'plan_duration'=>$request->plan_duration,
            'transaction_type'=>'subscription',
            'user'=>$request->user,
            'no_of_units'=>$request->no_of_units
        ];

        $amount = 0;
        $duration = $request->plan_duration == 3 ? 6 : 12; //6 or 12 months
        switch ($request->pl){
            case 1:
              $amount = ($request->no_of_units * 3000 * $duration)*100;
              break;
            case 2:
                $amount = ($request->no_of_units * 5500 * $duration)*100;
                break;
            case 3:
                $amount = ($request->no_of_units * 9900 * $duration)*100;
                break;
        }
        $arr[0] = json_encode($metadata);
        $request->request->add(['metadata' => $arr, 'amount' => $amount]);
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {

            session()->flash("error", "<strong>Whoops!</strong> Token expired. Refresh the page and try again. Or could not resolve host");
            return back();
        }
    }
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            session()->flash("error", "<strong>Ooops!</strong> Token expired. Refresh the page and try again.");
            return back();
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $metadata = json_decode($paymentDetails['data'] ['metadata'][0], true);
        $amount = $paymentDetails['data']['amount'];
        $current = Carbon::now();
        $key = "key_".substr(sha1(time()),21,40 );
        $transaction_type = $metadata['transaction_type'];
        #Sort out transaction type
        if($transaction_type == 'invoice'){
            $invoice_id = $metadata['invoice_id'];
            $invoice = $this->invoice->getInvoiceById($invoice_id);
            if(!empty($invoice)){
                $this->invoice->updateInvoicePayment($invoice, $amount/100);
                $this->receipt->generateOnlineReceipt($paymentDetails, $invoice);
                if($invoice->invoice_type == 2){ //lease renewal
                    $propertyObj = Property::find($invoice->property_id);
                    $frequencyObj = $this->leasefrequency->getLeaseFrequencyById($propertyObj->frequency);
                    $tenantObj = $this->tenant->getTenantById($invoice->tenant_id);
                    #Start & end date parameters
                    $daysLeft = strtotime($tenantObj->end_date)  > strtotime(now())  ? $current->diffInDays($tenantObj->end_date) : 0;
                    $daysPass = strtotime($tenantObj->end_date)  < strtotime(now())  ? $current->diffInDays($tenantObj->end_date) : 0;
                    $end_date =  strtotime($tenantObj->end_date)  > strtotime(now())
                        ? $current->parse($tenantObj->end_date)->addDays( $daysLeft + $frequencyObj->duration )
                        : $current->addDays( $frequencyObj->duration - $daysPass) ;
                    $this->tenant->updateTenantLease($invoice->tenant_id, $invoice->property_id, $key, now(), $end_date->toDateTimeString() );
                    #Register in lease renewal table
                    $this->leaserenewal->renewTenantLease($invoice->tenant_id, $invoice->company_id, $invoice->property_id, $key, now(), $end_date->toDateTimeString() );
                }
                session()->flash("success", "<strong>Great!</strong> Payment processed successfully.");
                return back();
            }else{
                session()->flash("error", "<strong>Whoops! No record found.");
                return back();
            }
        }
        if($transaction_type == 'subscription'){
            $user = $this->user->getUserById($metadata['user']);
            if(!empty($user)){
                $duration = $metadata['plan_duration'] == 3 ? 182 : 365;
                $company = $this->company->getCompanyByCompanyId($user->company_id);
                $plan = $metadata['plan'];
                $no_of_units = $metadata['no_of_units'];
                $sub_end_date = $company->end_date;
                $sub_key = $company->active_subscription_key;
                $users = $this->user->getAllUsersByCompanyId($user->company_id);
                $remainingDays = strtotime($sub_end_date) > strtotime(now()) ? $current->diffInDays($sub_end_date) : 0;
                $new_end_date = strtotime($sub_end_date) > strtotime(now()) ? $current->parse($sub_end_date)->addDays($remainingDays + $duration) : $current->addDays( $duration );
                #update subscription status
                if($remainingDays > 0){
                    $this->subscription->updateSubscriptionStatusByKey($sub_key, 3); //rollover
                }else{
                    $this->subscription->updateSubscriptionStatusByKey($sub_key, 2); //expired
                }
                #Register new subscription
                    $this->subscription->setNewSubscription($user->company_id, $plan, $key, now(), $new_end_date->toDateTimeString());
                #update company subscription
                    $this->company->updateCompanySubscription($company->id, $key,$no_of_units, $plan, now(), $new_end_date->toDateTimeString());
                #update users
                foreach($users as $u){
                    $this->user->updateUserAccountStatus($u->id, 1);
                }
                session()->flash("success", "<strong>Congratulations!</strong> You've successfully renewed your subscription.'" );
                return redirect()->route('subscription');
            }else{
                abort(404, 'Resource not found.');
            }

        }
    }

}
