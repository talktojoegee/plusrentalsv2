<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\Company;
use App\Models\Location;
use App\Models\Service;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function __construct(){
        $this->middleware('auth:manager');
        $this->service = new Service();
        $this->coa = new ChartOfAccount();
        $this->location = new Location();
        $this->company = new Company();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGeneralSettingsForm()
    {
        return view('manager.settings.general-settings', ['locations'=>$this->location->getLocations()]);
    }

    public function saveGeneralSettings(Request $request){
        $this->validate($request,[
            'company_name'=>'required',
            'mobile_no'=>'required',
            'location'=>'required',
            'area'=>'required',
            'city'=>'required',
            'address_1'=>'required'
        ],[
            'company_name.required'=>'Enter company name',
            'mobile_no.required'=>'Enter mobile number',
            'location.required'=>'Select your location',
            'area.required'=>'Select your area',
            'city.required'=>'Enter your city',
            'address_1.required'=>'Enter your primary address'
        ]);
        $this->company->updateCompanyDetails($request);
        if ($request->hasFile('favicon')) {
            $this->company->uploadFavicon($request);
        }
        if ($request->hasFile('logo')) {
            $this->company->uploadLogo($request);
        }
        session()->flash("success", "<strong>Success!</strong> Your changes were saved.");
        return back();

    }

    public function showGeneralServiceSettingsForm()
    {
        return view('manager.settings.service-settings', [
            'services'=>$this->service->getAllServices(),
            'accounts'=>$this->coa->getAllDetailChartOfAccounts()
        ]);
    }

    public function registerNewService(Request $request){
        $this->validate($request,[
            'service_name'=>'required|unique:services,service_name',
            'charge_type'=>'required',
            'charge_value'=>'required',
            //'glcode'=>'required'
        ]);
        $this->service->setNewService($request);
        session()->flash("success", "<strong>Success!</strong> New service registered.");
        return back();
    }

    public function updateService(Request $request){
        $this->validate($request,[
            'service'=>'required',
            'edit_service_name'=>'required',
            //'edit_glcode'=>'required',
            'edit_charge_type'=>'required',
            'edit_charge_value'=>'required'
        ]);
        $this->service->updateService($request);
        session()->flash("success", "<strong>Success!</strong> Changes saved.");
        return back();
    }

    public function savePaymentIntegration(Request $request){
        $this->validate($request,[
            'public_key'=>'required',
            'secret_key'=>'required'
        ],[
            'public_key.required'=>'Enter your Paystack live public key',
            'secret_key.required'=>'Enter your Paystack live secret key'
        ]);
        $this->company->updateTenantPaymentIntegration($request);
        session()->flash("success", "Your payment integration changes were saved successfully. Please don't forget to use <a href=''>http://plusrentals.com/process/payment</a> as your Callback URL");
        return back();
    }

    public function updateBulkSmsSettings(Request $request){
        $this->validate($request,[
            'sender_id'=>'required|max:10|unique:companies,sender_id'
        ],[
            'sender_id.required'=>'Kindly enter sender ID',
            'sender_id.min'=>'The maximum number of characters allowed is 10 characters',
            'sender_id.unique'=>"This sender ID is already taken. Choose another one"
        ]);
        $this->company->updateSenderId($request);
        session()->flash("success", "Your sender ID settings were updated successfully. Hold on for verification.");
        return back();
    }

    public function updateBankDetails(Request $request){
        $this->validate($request,[
            'bank_name'=>'required',
            'account_name'=>'required',
            'account_no'=>'required'
        ],[
            'bank_name.required'=>'Enter bank name',
            'account_name.required'=>'Enter account name',
            'account_no.required'=>'Enter account number'
        ]);
        $this->company->setBankDetails($request);
        session()->flash("success", "Record updated!");
        return back();
    }
}
