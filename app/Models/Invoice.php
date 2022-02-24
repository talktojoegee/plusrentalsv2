<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice as InV;
use App\Mail\Invoice as InvoiceMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Invoice extends Model
{
    use HasFactory;


    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getApplicant(){
        return $this->belongsTo(TenantApplicant::class, 'tenant_app_id');
    }

    public function getInvoiceItems(){
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    public function getIssuedBy(){
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function getPostedBy(){
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function getTrashedBy(){
        return $this->belongsTo(User::class, 'trashed_by');
    }

    public function getCompany(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }
    /*
     * Use-case methods
     */

    public function getAllUntrashedInvoices(){
        return InV::where('trashed',0)->where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function getLatestInvoiceNo(){
        return InV::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->first();
    }

    public function getInvoice($slug){
        return InV::where('slug', $slug)->first();

    }

    public function getInvoiceById($id){
        return InV::find($id);

    }

    public function sendInvoiceAsEmail($slug){
        $invoice = InV::where('slug', $slug)->first();
        #Email task
    }

    public function invoiceServiceTotal(Request $request){
        $total = 0;
        for($i = 0; $i<count($request->service); $i++){
            $total += ($request->amount[$i] * $request->quantity[$i]);
        };
        return $total;
    }

    public function registerInvoiceItems(Request $request, $invoiceId){
        for($i = 0; $i<count($request->service); $i++){
            $item = new InvoiceItem();
            $item->invoice_id = $invoiceId;
            $item->service_id = $request->service[$i];
            $item->quantity = $request->quantity[$i];
            $item->unit_cost = $request->amount[$i];
            $item->amount = $request->quantity[$i] * $request->amount[$i];
            $item->company_id = Auth::user()->company_id;
            $item->save();
        }
    }


    public function generateNewInvoiceForApplicant(Request $request, $applicant, $invoice_no){
       $invoice = new Invoice();
       $invoice->property_id = $applicant->property_id;
       $invoice->tenant_app_id = $applicant->id;
       $invoice->invoice_no = !empty($invoice_no) ? $invoice_no->invoice_no + 1 : 100000;
       $invoice->ref_no = substr(sha1(time()),32,40);
       $invoice->invoice_type = 1; //new lease
       $invoice->issue_date = $request->issue_date;
       $invoice->due_date = $request->due_date;
       $invoice->sub_total = $this->invoiceServiceTotal($request);
       $invoice->total = $this->invoiceServiceTotal($request);
       $invoice->issued_by = Auth::user()->id;
       $invoice->slug = substr(sha1(time()), 21,40);
       $invoice->company_id = Auth::user()->company_id;
       $invoice->save();
       #Recent invoice ID
        $invoiceId = $invoice->id;
        $this->registerInvoiceItems($request, $invoiceId);
    }

    public function generateNewInvoiceForTenant(Request $request, $tenant, $invoice_no){
       $invoice = new Invoice();
       $invoice->property_id = $tenant->property_id;
       $invoice->tenant_id = $tenant->id;
       $invoice->tenant_app_id = $tenant->tenant_app_id;
       $invoice->invoice_no = !empty($invoice_no) ? $invoice_no->invoice_no + 1 : 100000;
       $invoice->ref_no = substr(sha1(time()),32,40);
       $invoice->invoice_type = $request->invoice_type;
       $invoice->issue_date = $request->issue_date;
       $invoice->due_date = $request->due_date;
       $invoice->sub_total = $this->invoiceServiceTotal($request);
       $invoice->total = $this->invoiceServiceTotal($request);
       $invoice->issued_by = Auth::user()->id;
       $invoice->slug = substr(sha1(time()), 21,40);
       $invoice->company_id = Auth::user()->company_id;
       $invoice->save();
       #Recent invoice ID
        $invoiceId = $invoice->id;
        $this->registerInvoiceItems($request, $invoiceId);
    }

    public function generateNewInvoiceForSaleOfProperty(Request $request, $tenant, $invoice_no, $property){
       $invoice = new Invoice();
       $invoice->property_id = $property->id;
       $invoice->tenant_id = $tenant->id;
       $invoice->invoice_no = !empty($invoice_no) ? $invoice_no->invoice_no + 1 : 100000;
       $invoice->ref_no = substr(sha1(time()),32,40);
       $invoice->invoice_type = 3; // sale of property
       $invoice->issue_date = $request->issue_date;
       $invoice->due_date = $request->due_date;
       $invoice->sub_total = $this->invoiceServiceTotal($request);
       $invoice->total = $this->invoiceServiceTotal($request);
       $invoice->issued_by = Auth::user()->id;
       $invoice->slug = substr(sha1(time()), 21,40);
       $invoice->company_id = Auth::user()->company_id;
       $invoice->save();
       #Recent invoice ID
        $invoiceId = $invoice->id;
        $this->registerInvoiceItems($request, $invoiceId);
    }

    public function updateInvoiceStatus($invoice_id, $status){
        if($status == 'post'){
            $default_tenant_account = DefaultGLAccount::where('transaction', 'tenant_account')->first();
            $default_vat_account = DefaultGLAccount::where('transaction', 'tax_vat_account')->first();
            if(!empty($default_tenant_account)){
                $invoice = InV::find($invoice_id);
                $invoice->posted = 1;
                $invoice->posted_by = Auth::user()->id;
                $invoice->date_posted = now();
                $invoice->save();
                #General ledger posting [this will occur during invoice posting
                #GL posting [Tenant/Applicant]
                $tenant_gl = new GeneralLedger();
                $tenant_gl->glcode = $default_tenant_account->glcode;
                $tenant_gl->posted_by = Auth::user()->id;
                $tenant_gl->narration = "New invoice generated (Invoice No". $invoice->invoice_no .")";
                $tenant_gl->dr_amount = $invoice->total ?? 0;
                $tenant_gl->cr_amount = 0;
                $tenant_gl->ref_no =$invoice->ref_no;
                $tenant_gl->bank = 0;
                $tenant_gl->ob = 0;
                $tenant_gl->property_id = $invoice->property_id;
                $tenant_gl->created_at = $invoice->created_at;
                $tenant_gl->company_id = Auth::user()->company_id;
                $tenant_gl->save();
                /*#GL posting [VAT]
                $vat_gl = new GeneralLedger();
                $vat_gl->glcode = $default_vat_account->glcode;
                $vat_gl->posted_by = 1; //Auth::user()->id;
                $vat_gl->narration = "VAT collection on Invoice No". $invoice->invoice_no ;
                $vat_gl->dr_amount = 0;
                $vat_gl->cr_amount = 0; //$invoice->total * 7.5 ?? 0
                $vat_gl->ref_no =$invoice->ref_no;
                $vat_gl->bank = 0;
                $vat_gl->ob = 0;
                $vat_gl->property_id = $invoice->property_id;
                $vat_gl->created_at = $invoice->created_at;
                $vat_gl->save();*/

                #GL posting [Service]
                foreach($invoice->getInvoiceItems as $item){
                    $service_gl = new GeneralLedger();
                    $service_gl->glcode = $item->getService->glcode;
                    $service_gl->posted_by = Auth::user()->id;
                    $service_gl->narration = "New invoice generated (Invoice No". $invoice->invoice_no .")";
                    $service_gl->dr_amount = 0;
                    $service_gl->cr_amount = $item->amount ?? 0;
                    $service_gl->ref_no =$invoice->ref_no;
                    $service_gl->bank = 0;
                    $service_gl->ob = 0;
                    $service_gl->property_id = $invoice->property_id;
                    $service_gl->created_at = $invoice->created_at;
                    $service_gl->company_id = Auth::user()->company_id;
                    $service_gl->save();
                }
                return 1; //success
            }else{
                return 0; //failed
            }
        }else{
            $invoice = InV::find($invoice_id);
            $invoice->trashed = 1;
            $invoice->trashed_by = 1; //Auth::user()->id;
            $invoice->date_trashed = now();
            #Deduct paid amount
            $invoice->total -= $invoice->paid_amount;
            $invoice->status = 3; //0=pending,1=paid,2=partly-paid, 3=declined
            $invoice->save();

        }

    }

    public function sendInvoiceAsEmailService($invoice, $applicant){
        #Applicant
        //if($invoice->invoice_type == 1){
            try{
                \Mail::to($applicant)->send(new InvoiceMailer($invoice, $applicant));
            }catch (\Exception $exception){

            }
        //}elseif($invoice->invoice_type == 2 || $invoice->invoice_type == 3){
        //    \Mail::to($user)->send(new InvoiceMailer($invoice, $user));
       // }
    }

    public function generateOnlineInvoice($paymentDetails, $invoice, $services){
        #Generate invoice
        $ref = substr(sha1(time()),32,40);
        $counter = 0;
        $receiptNo = Receipt::orderBy('id', 'DESC')->first();
        if(!empty($receiptNo) ){
            $counter = $receiptNo->receipt_no + 1;
        }else{
            $counter = 100000;
        }
        $metadata = json_decode($paymentDetails['data'] ['metadata'][0], true);
        $amount = $paymentDetails['data']['amount'];
        //$property_id = $metadata['property'];
        //$tenant_id = $metadata['tenant'];
            #Update invoice
        $invoice->paid_amount += ($amount)/100 ?? 0;
        $invoice->status = $invoice->total == $invoice->paid_amount ? 1 : 2; //0=pending,1=paid,2=partly-paid, 3=declined
        $invoice->save();
        #Generate new receipt
        #General ledger posting [this will occur during receipt posting

       /* $default_tenant_account = DefaultGLAccount::where('transaction', 'tenant_account')->first();
            $invoice_gl = new GeneralLedger();
            $invoice_gl->glcode = $default_tenant_account->glcode;
            $invoice_gl->posted_by = 1; //Auth::user()->id;
            $invoice_gl->narration = "New invoice generated (Invoice No". $invoice->invoice_no .")";*/
        //if($invoice->total == $invoice->paid_amount){
            # payment is complete.
            //if($invoice->invoice_type == 1){
                #If it is applicant, make the person a tenant upon payment completion
                #we'll leave out this part for receipt posting

            //}

        //}
        $receipt = new Receipt;
        $receipt->receipt_no = $counter;
        $receipt->invoice_id = $invoice->id;
        $receipt->property_id = $invoice->property_id;
        $receipt->tenant_id = $invoice->invoice_type == 2 || $invoice->invoice_type == 3 ? $invoice->tenant_id : '';
        $receipt->tenant_app_id = $invoice->invoice_type == 1 ? $invoice->tenant_app_id : '';
        $receipt->payment_method = 4; //internet
        $receipt->payment_date = now();
        $receipt->trans_ref = $ref;
        $receipt->total = ($amount)/100 ?? 0;
        $receipt->sub_total = ($amount)/100 ?? 0;
        $receipt->company_id = Auth::user()->company_id;
        //$receipt->vat = 0;
        //$receipt->security_deposit =  0;
        //$receipt->late_fee =  0;
        $receipt->save();

    }

    public function updateInvoicePayment(InV $invoice, $amount){
        $invoice->paid_amount += ($amount) ?? 0;
        $invoice->status = $invoice->paid_amount >= $invoice->total  ? 1 : 2; //0=pending,1=fully-paid,2=partly-paid, 3=declined
        $invoice->save();
        return $invoice;
    }

    //public function autoDeclinePendingNewInvoicesByPropertyId(){}
}
