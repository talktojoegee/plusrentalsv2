<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\ChartOfAccount;
use App\Models\DefaultGLAccount;
use App\Models\LeaseFrequency;
use App\Models\LeaseRenewal;
use App\Models\Location;
use App\Models\PropertyInspectionSchedule;
use App\Models\PropertyLease;
use App\Models\RentalOwner;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyExteriorGallery;
use App\Models\PropertyInteriorGallery;
use Illuminate\Support\Facades\Auth;
use Image;
class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->property = new Property();
        $this->propertylease = new PropertyLease();
        $this->leaserenewal = new LeaseRenewal();
        $this->defaultgl = new DefaultGLAccount();
        $this->chartofaccount = new ChartOfAccount();
        $this->frequency = new LeaseFrequency();
        $this->propertyinspectionschedule = new PropertyInspectionSchedule();
        $this->user = new User();

    }


    public function showProperties()
    {
        $properties = $this->property->getAllCompanyProperties();
        return view('manager.property.index',['properties'=>$properties]);
    }


    public function showAddNewPropertyForm()
    {
        //$accounts = $this->chartofaccount->getAllDetailChartOfAccounts();
        $rental_owners = RentalOwner::orderBy('first_name', 'ASC')->get();
        $locations = Location::orderBy('location_name')->get();
        $frequencies = $this->frequency->getAllActiveFrequencies();
        return view('manager.property.add-new-property',
            [//'accounts'=>$accounts,
            'locations'=>$locations,
            'rental_owners'=>$rental_owners,
            'frequencies'=>$frequencies
                ]);
    }

    public function storeNewProperty(Request $request)
    {
        $this->validate($request,[
            'property_type'=>'required',
            'property_name'=>'required',
            'location'=>'required',
            'area'=>'required',
            //'address'=>'required',
            'frequency'=>'required',
            'rental_price'=>'required',
            'listing_type'=>'required'
        ]);
            #Check pricing plan if it covers accounting, # of properties allowed per month or all time
            /*$property_default_account = $this->defaultgl->getAccountByTransaction('property_account');
            if(empty($property_default_account)){
                session()->flash("error", "<strong>Ooops!</strong> There's no default property account. Visit <i>Accounting > Settings</i>");
                return back();
            }*/
            $this->property->setNewProperty($request/*, $property_default_account service suspended*/);
            session()->flash("success", "<strong>Great!</strong> New property added successfully.");
            return back();
    }


    public function getLocationArea(Request $request){
        $this->validate($request,[
            'location'=>'required'
        ]);
        $areas = Area::where('location_id', $request->location)->get();
        return view('manager.property.partials._areas', ['areas'=>$areas]);
    }


    public function viewProperty($slug){
        $property = $this->property->getProperty($slug);
        if(!empty($property)){
            $features = PropertyFeature::where('property_id', $property->id)->first();
            $leases = $this->leaserenewal->getPropertyLeaseByPropertyId($property->id);
            $inspections = $this->propertyinspectionschedule->getPropertyInspectionRequestByPropertyId($property->id);
            return view('manager.property.view-property',
                ['property'=>$property,
                    'features'=>$features,
                    'leases'=>$leases,
                    'inspections'=>$inspections,
                    'users'=>$this->user->getAllActiveUsers()
                ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }

    public function propertyInspection(){
        return view('manager.property.property-inspection',
            [
                'inspections'=>$this->propertyinspectionschedule->getAllPropertyInspectionRequests(),
                'users'=>$this->user->getAllActiveUsers()
            ]);
    }

    public function assignPropertyInspectionToUser(Request $request){
        $this->validate($request,[
            'assign_to'=>'required',
            'schedule_date'=>'required',
            'inspectionId'=>'required'
        ],[
            'assign_to.required'=>'Choose who to handle this task',
            'schedule_date.required'=>'When should this assignment be carried out?'
        ]);
        $this->propertyinspectionschedule->assignUserToPropertyInspectionRequest($request);
        session()->flash("success", "<strong>Success!</strong> Your changes were saved.");
        return back();

    }
    public function updatePropertyInspectionStatus(Request $request){
        $this->validate($request,[
            'status'=>'required',
            'inspection_id'=>'required'
        ],[
            'status.required'=>'Choose status'
        ]);
        $this->propertyinspectionschedule->updatePropertyInspectionStatus($request);
        session()->flash("success", "<strong>Success!</strong> Your changes were saved.");
        return back();

    }

}

