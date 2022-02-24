<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\DefaultGLAccount;
use App\Models\Vendor;
use App\Models\VendorProfession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->vendorprofession = new VendorProfession();
        $this->defaultgl = new DefaultGLAccount();
        $this->chartofaccount = new ChartOfAccount();
        $this->vendor = new Vendor();
    }

    public function manageVendors(){

        return view('manager.vendors.manage-vendors',[
            'vendors'=>$this->vendor->getAllCompanyVendors()
        ]);
    }

    public function manageVendorCategories(){
        return view('manager.vendors.vendor-profession', [
            'categories'=>$this->vendorprofession->getAllVendorProfessions()
        ]);
    }

    public function storeNewCategory(Request $request){
        $this->validate($request,[
            'profession_name'=>'required'
        ],[
            'profession_name.required'=>'Enter category name'
        ]);
        $this->vendorprofession->setVendorProfession($request);
        session()->flash("success", "<strong>Success!</strong> Your new vendor category was registered.");
        return back();
    }
    public function updateCategory(Request $request){
        $this->validate($request,[
            'profession_name'=>'required'
        ],[
            'profession_name.required'=>'Enter category name'
        ]);
        $this->vendorprofession->editVendorProfession($request);
        session()->flash("success", "<strong>Success!</strong> Your changes were saved.");
        return back();
    }

    public function showAddNewVendorForm(){
        $categories = $this->vendorprofession->getAllVendorProfessions();
        $default_vendor_account = $this->defaultgl->getAccountByTransaction('vendor_account');
        $accounts = $this->chartofaccount->getAllDetailChartOfAccounts();
        if(count($categories) <= 0 || empty($default_vendor_account)){
            session()->flash("error", "<strong>Whoops!</strong> Either your have not setup a default vendor account or categories is not published. Kindly do that before you proceed");
            return back();
        }
        return view('manager.vendors.add-new-vendor',[
            'accounts'=>$accounts,
            'categories'=>$categories
        ]);
    }

    public function storeNewVendor(Request $request){
        $default_account = $this->defaultgl->getAccountByTransaction('vendor_account');
        if($request->vendor_type == 1){
            $this->validate($request,[
                'first_name'=>'required',
                'surname'=>'required',
                'email'=>'required|email',
                'mobile_no'=>'required',
                'address'=>'required',
                'default_account'=>'required',
                'vendor_type'=>'required',
                'category'=>'required'
            ],[
                'first_name.required'=>'Enter first name',
                'surname.required'=>'Enter surname',
                'email.required'=>'Enter a valid email address',
                'email.email'=>'Enter a valid email address',
                'mobile_no.required'=>'Enter mobile number',
                'address.required'=>'Enter contact address',
                'default_account.required'=>'Associate an account to this vendor',
                'vendor_type'=>'Select the kind of vendor',
                'category.required'=>'Select the category'
            ]);
        }else if($request->vendor_type == 2){
            $this->validate($request,[
                'company_name'=>'required',
                'official_phone_no'=>'required',
                'official_email'=>'required|email',
                'office_address'=>'required',
                'default_account'=>'required',
                'vendor_type'=>'required',
                'category'=>'required'
            ],[
                'company_name.required'=>'Enter company name',
                'official_phone_no.required'=>'Enter official phone number',
                'official_email.required'=>'Enter a valid official email address',
                'official_email.email'=>'Enter a valid official email address',
                'office_address.required'=>'Enter office address',
                'default_account.required'=>'Associate an account to this vendor',
                'vendor_type'=>'Select the kind of vendor',
                'category.required'=>'Select the category'
            ]);
        }
        $this->vendor->setVendor($request, $default_account);
        session()->flash("success", "<strong>Congratulations!</strong> You've successfully added a new vendor to your account.");
        return back();
    }

    public function viewVendor($slug){
        $vendor = $this->vendor->getVendorBySlug($slug);
        if(!empty($vendor)){
            return view('manager.vendors.view-vendor', ['vendor'=>$vendor,
                'categories'=>$this->vendorprofession->getAllVendorProfessions()]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }

    public function updateVendor(Request $request){

        $default_account = $this->defaultgl->getAccountByTransaction('vendor_account');
        if($request->vendor_type == 1){
            $this->validate($request,[
                'first_name'=>'required',
                'surname'=>'required',
                'email'=>'required|email',
                'mobile_no'=>'required',
                'address'=>'required',
                //'default_account'=>'required',
                'vendor_type'=>'required',
                'category'=>'required'
            ],[
                'first_name.required'=>'Enter first name',
                'surname.required'=>'Enter surname',
                'email.required'=>'Enter a valid email address',
                'email.email'=>'Enter a valid email address',
                'mobile_no.required'=>'Enter mobile number',
                'address.required'=>'Enter contact address',
                //'default_account.required'=>'Associate an account to this vendor',
                'vendor_type'=>'Select the kind of vendor',
                'category.required'=>'Select the category'
            ]);
        }else if($request->vendor_type == 2){
            $this->validate($request,[
                'company_name'=>'required',
                'official_phone_no'=>'required',
                'official_email'=>'required|email',
                'office_address'=>'required',
                'vendor'=>'required',
                'vendor_type'=>'required',
                'category'=>'required'
            ],[
                'company_name.required'=>'Enter company name',
                'official_phone_no.required'=>'Enter official phone number',
                'official_email.required'=>'Enter a valid official email address',
                'official_email.email'=>'Enter a valid official email address',
                'office_address.required'=>'Enter office address',
                //'default_account.required'=>'Associate an account to this vendor',
                'vendor_type'=>'Select the kind of vendor',
                'category.required'=>'Select the category'
            ]);
        }
        $this->vendor->editVendor($request, $default_account);
        session()->flash("success", "<strong>Congratulations!</strong> Your changes were saved successfully.");
        return back();
    }
}
