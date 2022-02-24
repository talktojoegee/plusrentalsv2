<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Vendor;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->bill = new Bill();
        $this->billitem = new BillItem();
        $this->property = new Property();
        $this->vendor = new Vendor();
        $this->payment = new Payment();
    }

    public function manageBills(){

        return view('manager.vendors.bills.index', [
            'bills'=>$this->bill->getAllUntrashedBills()
            ]);
    }

    public function showNewBillForm(){
        return view('manager.vendors.bills.new-bill',[
            'properties'=>$this->property->getAllCompanyProperties(),
            'vendors'=>$this->vendor->getAllCompanyVendors()
        ]);
    }
    public function generateNewBill(Request $request){
        if(empty($request->bill_type)){
            session()->flash("error", "<strong>Whoops!</strong> Kindly select bill type");
            return back();
        }
        $this->validate($request,[
            'bill_type'=>'required',
            'vendor'=>'required',
            'issue_date'=>'required|date',
            'due_date'=>'required|date',
            'service.*'=>'required'
        ],[
            'vendor.required'=>'Select vendor from your list of vendors',
            'issue_date.required'=>'Choose issue date',
            'issue_date.date'=>'Issue date must be a date input',
            'due_date.required'=>'Choose due date',
            'due_date.date'=>'Due date must be a date input',
        ]);

        $vendor = $this->vendor->getVendorById($request->vendor);
        if(!empty($vendor)) {
            $bill_no = $this->bill->getLatestBillNo();
            $this->bill->generateNewBill($request, $vendor, $bill_no);
            session()->flash("success", "<strong>Success!</strong> New bill generated.");
            return back();
        }


    }

    public function viewBill($slug){
        $bill = $this->bill->getBillBySlug($slug);
        if(!empty($bill)){
            return view('manager.vendors.bills.view-bill',['bill'=>$bill]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }


    public function declineBill($slug){
        $bill = $this->bill->getBillBySlug($slug);
        if(!empty($bill)){
            $this->bill->updateBillStatus($bill->id, 'decline');
            session()->flash("success", "<strong>Success!</strong> Bill declined.");
            return back();
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }
    public function approveBill($slug){
        $bill = $this->bill->getBillBySlug($slug);
        if(!empty($bill)){
            $status = $this->bill->updateBillStatus($bill->id, 'post');
            if($status == 0){
                session()->flash("error", "<strong>Whoops!</strong> Kindly setup default accounts for transactions like this.");
                return back();
            }else{
                session()->flash("success", "<strong>Success!</strong> Bill posted.");
                return back();
            }
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }

    public function sendBillAsEmail($slug){
        $bill = $this->bill->getBillBySlug($slug);
        if(!empty($bill)){
            #vendor
            $vendor = $this->vendor->getVendorById($bill->vendor_id);
            if(!empty($vendor)){
                $this->bill->sendBillAsEmailService($bill, $vendor);
                session()->flash("success", "<strong>Success!</strong> Bill sent.");
                return back();
            }else{
                session()->flash("error", "<strong>There's no record for this vendor.");
                return back();
            }
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }
    public function makePayment($slug){
        $bill = $this->bill->getBillBySlug($slug);
        if(!empty($bill)){
            return view('manager.vendors.payments.make-payment',['bill'=>$bill]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }

    public function processNewPayment(Request $request){
        $this->validate($request,[
            'amount'=>'required',
            'bill'=>'required'
        ],[
            'amount.required'=>'Enter an amount to process payment'
        ]);
        $bill = $this->bill->getBillById($request->bill);// $this->invoice->getInvoiceById($request->invoice);
        if(!empty($bill)){
            $this->bill->updateBillPayment($bill, $request->amount);
            $this->payment->generatePayment($request, $bill);
            session()->flash("success", "<strong>Congratulations!</strong> Your bill payment request was processed successfully.");
            return back();
        }else{
            session()->flash("error", "<strong>Whoops!</strong> Bill does not exist. Try again.");
            return back();
        }
    }

    public function managePayments(){
        return view('manager.vendors.payments.index',['payments'=>$this->payment->getAllCompanyPayments()]);
    }

    public function viewPayment($slug){
        $payment = $this->payment->getPaymentBySlug($slug);
        if(!empty($payment)){
            return view('manager.vendors.payments.view', ['payment'=>$payment]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }


    public function approvePayment($slug){
        $payment = $this->payment->approvePayment($slug);
        if($payment == 1){
            session()->flash("success", "<strong>Great!</strong> Payment approved and posted to ledger. ");
            return redirect()->route('manage-payments');
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Something went wrong. Please try again or contact admin.");
            return redirect()->route('manage-receipts');
        }
    }

    public function declinePayment($slug){
        $payment = $this->payment->declinePayment($slug);
        if($payment == 1){
            session()->flash("success", "<strong>Great!</strong> Payment declined. ");
            return redirect()->route('manage-payments');
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Something went wrong. Please try again or contact admin.");
            return redirect()->route('manage-receipts');
        }
    }
}
