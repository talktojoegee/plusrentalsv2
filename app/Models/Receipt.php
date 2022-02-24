<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Receipt as ReceiptMailer;
use Paystack;

class Receipt extends Model
{
    use HasFactory;


    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getPaidBy(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getInvoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }



    /*
     * Use-case methods
     */

    public function getAllReceipts(){
        return  Receipt::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }


    public function getReceipt($slug){
        $receipt = Receipt::where('trans_ref', $slug)->first();
        return $receipt;
    }

    public function getLastReceipt(){
        return Receipt::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->first();
    }

    public function sendReceiptAsEmail($slug){
        $receipt = Receipt::where('trans_ref', $slug)->first();
        #Email task
    }

    public function getLatestReceipt(){
        return Receipt::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->first();
    }

   /* public function generateOnlineReceipt($paymentDetails){
        #Generate receipt
        $ref = substr(sha1(time()),34,40);
        $counter = 0;
        $last_receipt = $this->getLastReceipt();
        $default_tenant_account = DefaultGLAccount::where('transaction', 'tenant_account')->first();
        $counter = null;
        if(!empty($last_receipt)){
            $counter = $last_receipt->receipt_no + 1;
        }else{
            $counter = 100000;
        }
        $metadata = json_decode($paymentDetails['data'] ['metadata'][0], true);
        $amount = $paymentDetails['data']['amount'];
        $property_id = $metadata['property'];
        $tenant_id = $metadata['tenant'];

        $receipt = new Receipt;
        $receipt->receipt_no = $counter;
        $receipt->property_id = $property_id;
        $receipt->tenant_id = $tenant_id;
        $receipt->payment_method = 4; //internet
        $receipt->payment_date = now();
        $receipt->trans_ref = $ref;
        $receipt->total = ($amount)/100 ?? 0;
        $receipt->sub_total = 0;
        $receipt->vat = 0;
        $receipt->security_deposit =  0;
        $receipt->late_fee =  0;
        $receipt->save();

    }*/

    public function approveReceipt($slug){
        $receipt = Receipt::where('trans_ref', $slug)->first();
        $ref = substr(sha1(time()),30,40);
        if(!empty($receipt)){
            #Property
                $property = Property::find($receipt->property_id);
            #Tenant
                $tenant = Tenant::find($receipt->tenant_id);
                $default_tenant_account = DefaultGLAccount::where('transaction', 'tenant_account')->where('company_id', Auth::user()->company_id)->first();
                $default_bank_account = DefaultGLAccount::where('transaction', 'bank_account')->where('company_id', Auth::user()->company_id)->first();
                if(!empty($default_tenant_account) || !empty($default_bank_account)){
                    #GL posting [Bank]
                    #Debit transaction
                    $debit = new GeneralLedger();
                    $debit->glcode = $default_bank_account->glcode;
                    $debit->dr_amount = $receipt->total ?? 0;
                    $debit->cr_amount = 0;
                    $debit->property_id = $receipt->property_id;
                    $debit->posted_by = Auth::user()->id;
                    $debit->ref_no = $receipt->trans_ref;
                    $debit->narration = "Payment received with Receipt No. ".$receipt->receipt_no;
                    $debit->created_at = $receipt->created_at;
                    $debit->company_id = Auth::user()->company_id;
                    $debit->save();

                    #GL posting [Receipt/ReceiptItems]
                    #Credit transaction
                    $credit = new GeneralLedger();
                    $credit->glcode = $default_tenant_account->glcode;
                    $credit->cr_amount = $receipt->total ?? 0;
                    $credit->dr_amount = 0;
                    $credit->property_id = $receipt->property_id;
                    $credit->posted_by = Auth::user()->id;
                    $credit->ref_no = $receipt->trans_ref;
                    $credit->narration = "Payment received with Receipt No. ".$receipt->receipt_no;
                    $credit->created_at = $receipt->created_at;
                    $credit->company_id = Auth::user()->company_id;
                    $credit->save();
                    #Update receipt details
                    $receipt->posted_by = Auth::user()->id;
                    $receipt->posted = 1; //yes
                    $receipt->date_posted = now();
                    $receipt->save();
                    //\Mail::to($tenant)->send(new ReceiptMailer($receipt));

                    return 1; //success
                }else{
                    return 0; //failed
                }
                return 1;//success
        }else{
            return 0; //failed
        }
    }
    public function declineReceipt($slug){
        $receipt = Receipt::where('trans_ref', $slug)->first();
        if(!empty($receipt)){
           #Update receipt details
                $receipt->posted_by = Auth::user()->id; //declined by
                $receipt->posted = 2; //receipt posting declined
                $receipt->date_posted = now(); //date declined
                $receipt->save();
            return 1; //success
        }else{
            return 0; //failed
        }
    }

    public function generateOfflineReceipt(Request $request, $invoice){
        $last_receipt = $this->getLastReceipt();
        $default_tenant_account = DefaultGLAccount::where('transaction', 'tenant_account')->first();
        $counter = null;
        if(!empty($last_receipt)){
            $counter = $last_receipt->receipt_no + 1;
        }else{
            $counter = 100000;
        }

        #If it is new lease, register applicant as tenant then schedule lease on pending mode
        if($invoice->invoice_type == 1){ //new lease
            #Applicant
            $applicant = TenantApplicant::find($invoice->tenant_app_id);
            $applicant->status = 1; //applicant application approved
            $applicant->save();
            #Check if tenant already exists
            $tenant_existence = Tenant::where('tenant_app_id', $applicant->id)->first();
            if(empty($tenant_existence)){
                #Tenant
                $tenantId = $this->createNewTenant($applicant, $default_tenant_account, $invoice);
                $this->updateInvoiceTenantId($invoice, $tenantId);
                #Enlist for schedule
                $this->createNewLeaseSchedule($tenantId, $invoice);
                $this->updatePropertyStatusAsOccupied($invoice, $tenantId);
                $this->createNewReceipt($counter, $invoice, $request->amount);
            }
        }elseif($invoice->invoice_type == 2){ //lease renewal
            $this->updateInvoiceTenantId($invoice, $invoice->tenant_id);
            #Enlist for schedule
            $this->createNewLeaseSchedule($invoice->tenant_id, $invoice);
            $this->updatePropertyStatusAsOccupied($invoice, $invoice->tenant_id);
            $this->createNewReceipt($counter, $invoice, $request->amount);
        }elseif($invoice->invoice_type == 3){ //sale of property
            $this->updateInvoiceTenantId($invoice, $invoice->tenant_id);
            #Enlist for schedule
            $this->createNewLeaseSchedule($invoice->tenant_id, $invoice);
            $this->updatePropertyStatusAsOccupied($invoice, $invoice->tenant_id);
            $this->createNewReceipt($counter, $invoice, $request->amount);
        }elseif($invoice->invoice_type == 4){ //others
            $this->updateInvoiceTenantId($invoice, $invoice->tenant_id);
        }

    }
    public function generateOnlineReceipt($paymentDetails, $invoice){
        $last_receipt = $this->getLastReceipt();
        $default_tenant_account = DefaultGLAccount::where('transaction', 'tenant_account')->first();
        $counter = null;
        if(!empty($last_receipt)){
            $counter = $last_receipt->receipt_no + 1;
        }else{
            $counter = 100000;
        }
        $metadata = json_decode($paymentDetails['data'] ['metadata'][0], true);
        $amount = $paymentDetails['data']['amount'];
        //$property_id = $metadata['property'];
        //$tenant_id = $metadata['tenant'];

        #If it is new lease, register applicant as tenant then schedule lease on pending mode
        if($invoice->invoice_type == 1){ //new lease
            #Applicant
            $applicant = TenantApplicant::find($invoice->tenant_app_id);
            $applicant->status = 1; //applicant application approved
            $applicant->save();
            #Check if tenant already exists
            $tenant_existence = Tenant::where('tenant_app_id', $applicant->id)->first();
            if(empty($tenant_existence)){
                #Tenant
                $tenantId = $this->createNewTenant($applicant, $default_tenant_account, $invoice);
                $this->updateInvoiceTenantId($invoice, $tenantId);
                #Enlist for schedule
                $this->createNewLeaseSchedule($tenantId, $invoice);
                $this->updatePropertyStatusAsOccupied($invoice, $tenantId);
                $this->createNewReceipt($counter, $invoice, $amount);
            }
        }elseif($invoice->invoice_type == 2){ //lease renewal
            $this->updateInvoiceTenantId($invoice, $invoice->tenant_id);
            $this->createNewReceipt($counter, $invoice, $amount);
        }elseif($invoice->invoice_type == 3){ //sale of property
            $this->updateInvoiceTenantId($invoice, $invoice->tenant_id);
            #Enlist for schedule
            $this->createNewLeaseSchedule($invoice->tenant_id, $invoice);
            $this->updatePropertyStatusAsOccupied($invoice, $invoice->tenant_id);
            $this->createNewReceipt($counter, $invoice, $amount);
        }

    }

    public function createNewTenant(TenantApplicant $applicant, $default_tenant_account, $invoice){
        $tenant = new Tenant();
        $tenant->email = $applicant->email;
        $tenant->tenant_app_id = $applicant->id;
        $tenant->avatar = 'avatar.png';
        $tenant->tenant_glcode = $default_tenant_account->glcode;
        $tenant->property_id = $invoice->property_id;
        $tenant->slug = substr(sha1(time()),33,40);
        $tenant->password = bcrypt('password123');
        $tenant->company_id = Auth::user()->company_id;
        $tenant->save();
        return $tenant->id;
    }

    public function createNewLeaseSchedule($tenantId, $invoice){
        $schedule = new ScheduleLease();
        $schedule->tenant_id = $tenantId;
        $schedule->property_id = $invoice->property_id;
        $schedule->trans_ref = $invoice->ref_no;
        $schedule->scheduled_by = Auth::user()->id;
        $schedule->status = 0; //pending
        $schedule->slug = substr(sha1(time()),32,40);
        $schedule->company_id = Auth::user()->company_id;
        $schedule->save();
    }

    public function createNewReceipt($counter, $invoice, $amount){
        $receipt = new Receipt;
        $receipt->receipt_no = $counter;
        $receipt->invoice_id = $invoice->id;
        $receipt->property_id = $invoice->property_id;
        $receipt->tenant_id = $invoice->tenant_id;
        $receipt->tenant_app_id = $invoice->invoice_type == 1 ? $invoice->tenant_app_id : '';
        $receipt->payment_method = 1; //cash
        $receipt->payment_date = now();
        $receipt->trans_ref = $this->generateTransactionRef();
        $receipt->total = ($amount) ?? 0;
        $receipt->sub_total = ($amount) ?? 0;
        $receipt->receipt_type = $invoice->invoice_type ?? 1;
        $receipt->company_id = $invoice->company_id;
        $receipt->save();
    }

    public function updatePropertyStatusAsOccupied($invoice, $tenantId){
        $property = Property::find($invoice->property_id);
        if(!empty($property)){
            $property->status = 1; //occupied
            $property->allocated_to = $tenantId;
            $property->save();
        }
    }

    public function generateTransactionRef(){
        return substr(sha1(time()),32,40);
    }

    public function updateInvoiceTenantId($invoice, $tenantId){
        $invoice->tenant_id = $tenantId;
        $invoice->save();
    }

}
