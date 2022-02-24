<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\BillMailer;
class Bill extends Model
{
    use HasFactory;

    public function getVendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function getBillItems(){
        return $this->hasMany(BillItem::class, 'bill_id');
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
    public function getAllUntrashedBills(){
        return Bill::where('trashed',0)->where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function getLatestBillNo(){
        return Bill::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->first();
    }

    public function getBillBySlug($slug){
        return Bill::where('slug', $slug)->first();

    }

    /*public function getAllCompanyBills(){
        return Bill::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }*/
    public function getBillById($id){
        return Bill::find($id);
    }
    public function generateNewBill(Request $request, $vendor, $bill_no){
        $bill = new Bill();
        $bill->property_id = $request->bill_type == 1 ? $request->property : '';
        $bill->vendor_id = $vendor->id;
        $bill->bill_no = !empty($bill_no) ? $bill_no->bill_no + 1 : 100000  ;
        $bill->ref_no = substr(sha1(time()),32,40);
        $bill->bill_type = $request->bill_type;
        $bill->issue_date = $request->issue_date;
        $bill->due_date = $request->due_date;
        $bill->sub_total = $this->billServiceTotal($request);
        $bill->total = $this->billServiceTotal($request);
        $bill->issued_by = Auth::user()->id;
        $bill->slug = substr(sha1(time()), 21,40);
        $bill->company_id = Auth::user()->company_id;
        $bill->save();
        #Recent bill ID
        $billId = $bill->id;
        $this->registerBillItems($request, $billId);
    }
    public function billServiceTotal(Request $request){
        $total = 0;
        for($i = 0; $i<count($request->service); $i++){
            $total += ($request->amount[$i] * $request->quantity[$i]);
        };
        return $total;
    }

    public function registerBillItems(Request $request, $billId){
        for($i = 0; $i<count($request->service); $i++){
            $item = new BillItem();
            $item->bill_id = $billId;
            $item->service_description = $request->service[$i];
            $item->quantity = $request->quantity[$i];
            $item->unit_cost = $request->amount[$i];
            $item->amount = $request->quantity[$i] * $request->amount[$i];
            $item->company_id = Auth::user()->company_id;
            $item->save();
        }
    }

    public function updateBillStatus($bill_id, $status){
        if($status == 'post'){
            $default_vendor_account = DefaultGLAccount::where('transaction', 'vendor_account')->first();
            $default_vendor_service_account = DefaultGLAccount::where('transaction', 'vendor_service_account')->first();
            //$default_vat_account = DefaultGLAccount::where('transaction', 'tax_vat_account')->first();
            if(!empty($default_vendor_account)){
                $bill = Bill::find($bill_id);
                $bill->posted = 1;
                $bill->posted_by = Auth::user()->id;
                $bill->date_posted = now();
                $bill->save();
                #General ledger posting [this will occur during invoice posting
                #GL posting [Tenant/Applicant]
                $vendor_gl = new GeneralLedger();
                $vendor_gl->glcode = $default_vendor_account->glcode;
                $vendor_gl->posted_by = Auth::user()->id;
                $vendor_gl->narration = "New bill generated (Bill No". $bill->bill_no .")";
                $vendor_gl->cr_amount = $bill->total ?? 0;
                $vendor_gl->dr_amount = 0;
                $vendor_gl->ref_no = $bill->ref_no;
                $vendor_gl->bank = 0;
                $vendor_gl->ob = 0;
                $vendor_gl->property_id = $bill->property_id ?? '';
                $vendor_gl->created_at = $bill->created_at;
                $vendor_gl->company_id = Auth::user()->company_id;
                $vendor_gl->save();
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
                foreach($bill->getBillItems as $item){
                    $service_gl = new GeneralLedger();
                    $service_gl->glcode = $default_vendor_service_account->glcode;
                    $service_gl->posted_by = Auth::user()->id;
                    $service_gl->narration = 'Service: '.$item->service_description; //"New invoice generated (Invoice No". $invoice->invoice_no .")";
                    $service_gl->cr_amount = 0;
                    $service_gl->dr_amount = $item->amount ?? 0;
                    $service_gl->ref_no =$bill->ref_no;
                    $service_gl->bank = 0;
                    $service_gl->ob = 0;
                    $service_gl->property_id = $bill->property_id ?? '';
                    $service_gl->created_at = $bill->created_at;
                    $service_gl->company_id = Auth::user()->company_id;
                    $service_gl->save();
                }
                return 1; //success
            }else{
                return 0; //failed
            }
        }else{
            $bill = Bill::find($bill_id);
            $bill->trashed = 1;
            $bill->trashed_by = 1; //Auth::user()->id;
            $bill->date_trashed = now();
            #Deduct paid amount
            $bill->total -= $bill->paid_amount;
            $bill->status = 3; //0=pending,1=paid,2=partly-paid, 3=declined
            $bill->save();

        }

    }

    public function sendBillAsEmailService($bill, $vendor){
        #Vendor
        try{
            \Mail::to($vendor)->send(new BillMailer($bill, $vendor));
        }catch (\Exception $exception){

        }
    }

    public function updateBillPayment(Bill $bill, $amount){
        $bill->paid_amount += ($amount) ?? 0;
        $bill->status = $bill->paid_amount >= $bill->total  ? 1 : 2; //0=pending,1=fully-paid,2=partly-paid, 3=declined
        $bill->save();
        return $bill;
    }
}
