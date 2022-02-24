<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    use HasFactory;


    public function getVendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function getBill(){
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    /*
     * Use-case methods
     */
    public function generatePayment(Request $request, $bill){
        $last_payment = $this->getLastPayment();
        $default_vendor_account = DefaultGLAccount::where('transaction', 'vendor_account')->first();
        $counter = null;
        if(!empty($last_payment)){
            $counter = $last_payment->payment_no + 1;
        }else{
            $counter = 100000;
        }
        $this->createNewPayment($counter, $bill, $request->amount);

    }

    public function getLastPayment(){
        return Payment::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->first();
    }

    public function createNewPayment($counter, $bill, $amount){
        $b = new Payment();
        $b->payment_no = $counter;
        $b->bill_id = $bill->id;
        $b->property_id = $bill->property_id ?? '';
        $b->vendor_id = $bill->vendor_id;
        //$receipt->tenant_app_id = $bill->invoice_type == 1 ? $bill->tenant_app_id : '';
        $b->payment_method = 1; //cash
        $b->payment_date = now();
        $b->trans_ref = $this->generateTransactionRef();
        $b->total = ($amount) ?? 0;
        $b->sub_total = ($amount) ?? 0;
        $b->payment_type = $bill->bill_type ?? 1;
        $b->company_id = $bill->company_id;
        $b->save();
    }
    public function generateTransactionRef(){
        return substr(sha1(time()),32,40);
    }

    public function getAllCompanyPayments(){
        return Payment::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function getPaymentBySlug($slug){
        return Payment::where('trans_ref', $slug)->first();
    }

    public function approvePayment($slug){
        $payment = Payment::where('trans_ref', $slug)->first();
        $ref = substr(sha1(time()),30,40);
        if(!empty($payment)){
            #Property
            //$property = Property::find($payment->property_id);
            #Tenant
            $vendor = Vendor::find($payment->vendor_id);
            $default_vendor_account = DefaultGLAccount::where('transaction', 'vendor_account')->where('company_id', Auth::user()->company_id)->first();
            $default_bank_account = DefaultGLAccount::where('transaction', 'bank_account')->where('company_id', Auth::user()->company_id)->first();
            if(!empty($default_vendor_account) || !empty($default_bank_account)){
                #GL posting [Bank]
                #Debit transaction
                $debit = new GeneralLedger();
                $debit->glcode = $default_bank_account->glcode;
                $debit->cr_amount = $payment->total ?? 0;
                $debit->dr_amount = 0;
                $debit->property_id = $payment->property_id ?? '';
                $debit->posted_by = Auth::user()->id;
                $debit->ref_no = $payment->trans_ref;
                $debit->narration = "Payment done for bill No. ".$payment->getBill->bill_no;
                $debit->created_at = $payment->created_at;
                $debit->company_id = Auth::user()->company_id;
                $debit->save();

                #GL posting [Receipt/ReceiptItems]
                #Credit transaction
                $credit = new GeneralLedger();
                $credit->glcode = $default_vendor_account->glcode;
                $credit->dr_amount = $payment->total ?? 0;
                $credit->cr_amount = 0;
                $credit->property_id = $payment->property_id ?? '';
                $credit->posted_by = Auth::user()->id;
                $credit->ref_no = $payment->trans_ref;
                $credit->narration = "Payment done for bill No. ".$payment->getBill->bill_no;
                $credit->created_at = $payment->created_at;
                $credit->company_id = Auth::user()->company_id;
                $credit->save();
                #Update receipt details
                $payment->posted_by = Auth::user()->id;
                $payment->posted = 1; //yes
                $payment->date_posted = now();
                $payment->save();
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
    public function declinePayment($slug){
        $payment = Payment::where('trans_ref', $slug)->first();
        if(!empty($payment)){
            #Update receipt details
            $payment->posted_by = Auth::user()->id; //declined by
            $payment->posted = 2; //receipt posting declined
            $payment->date_posted = now(); //date declined
            $payment->save();
            return 1; //success
        }else{
            return 0; //failed
        }
    }
}
