<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LeaseFrequency;
use App\Models\Property;
use App\Models\PropertyFeature;
use Illuminate\Http\Request;
use App\Models\TenantApplicant;

class ApplicationController extends Controller
{

    public function __construct(){
        $this->middleware('auth:manager');
        $this->tenantapp = new TenantApplicant();
        $this->property = new Property();
        $this->leasefrequency = new LeaseFrequency();
    }



    public function showApplicationForm(){
        return view('manager.applicants.new-application');
    }

    public function storeApplication(Request $request){

        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            //'gender'=>'required',
            'email'=>'required|unique:tenant_applicants,email',
            'mobile_no'=>'required',
            'address'=>'required',
            'date_of_residency'=>'required'
        ]);
        $this->tenantapp->setNewTenantApplication($request);
        session()->flash("success", "<strong>Success!</strong> Tenant application submitted.");
        return back();
    }


    public function showProspectApplications(){
        $applications = TenantApplicant::orderBy('id', 'DESC')->get();
        return view('manager.applicants.applications',['applications'=>$applications]);
    }

    public function viewApplication($slug){
        $applicant = TenantApplicant::where('url', $slug)->first();
        if(!empty($applicant)){
            $features = PropertyFeature::where('property_id', $applicant->property_id)->first();
            return view('manager.applicants.view-application',['applicant'=>$applicant, 'features'=>$features]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record does not exist.");
            return back();
        }
    }


    public function approveProspectApplication($slug, $applicant){
        $property = $this->property->getProperty($slug);
        $applicant = $this->tenantapp->getTenantApplicant($applicant);
        $frequencies = $this->leasefrequency->getAllActiveFrequencies();
        if(!empty($property) && !empty($applicant)){
            return view('manager.applicants.submit-lease-application', ['applicant'=>$applicant, 'property'=>$property, 'frequencies'=>$frequencies]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found");
            return back();
        }
    }
}
