<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:tenant');
        $this->receipt = new Receipt();
        $this->invoice = new Invoice();
    }

    public function myReports(){
        return view('tenant.reports');
    }


    public function myReceiptDetails($slug){
        $receipt = $this->receipt->getReceipt($slug);
        if(!empty($receipt)){
            return view('tenant.receipt-detail', ['receipt'=>$receipt]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }

    public function myInvoiceDetails($slug){
        $invoice = $this->invoice->getInvoice($slug);
        if(!empty($invoice)){
            return view('tenant.invoice-detail', ['invoice'=>$invoice]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }
}
