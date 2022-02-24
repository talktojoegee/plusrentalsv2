<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskFrontendConversation;
use App\Models\TenantApplicant;
use App\Models\TenantNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaseRenewal;
use App\Models\Property;
use App\Models\Receipt;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Hash;

class ResidentController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth:tenant');
        $this->receipt = new Receipt();
        $this->property = new Property();
        $this->tenant = new Tenant();
        $this->leaserenewal = new LeaseRenewal();
        $this->tenantapp = new TenantApplicant();
        $this->task = new Task();
        $this->taskfront = new TaskFrontendConversation();
        $this->maintenancerequest = new MaintenanceRequest();
        $this->tenantnotification = new TenantNotification();
        $this->taskcategory = new TaskCategory();
    }


    public function profile(){
        $latest = $this->receipt->getLatestReceipt();
        return view('tenant.profile', ['latest'=>$latest]);
    }

    public function myLeases(){
        $my_leases = $this->leaserenewal->getAllMyLeases(Auth::user()->id);
        return view('tenant.my-leases', ['my_leases'=>$my_leases]);
    }

    public function propertyDetails($slug){
        $property = $this->property->getProperty($slug);
        if(!empty($property)){
            return view('tenant.property-details',[
                'property'=>$property
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }


    public function payRent(){
        $property = $this->tenant->getTenantAllocatedProperty();
        if(!empty($property)){
            return view('tenant.pay-rent',['property'=>$property, 'status'=>1]);
        }else{
            session()->flash("danger", "Ooops! You're currently not renting any property. This action cannot be continued. Please contact the admin.");
            return view('tenant.pay-rent', ['property'=>[], 'status'=>0]);
        }
    }

    public function showSettingsForm(){
        return view('tenant.settings');
    }

    public function updateTenantRecord(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'address'=>'required'
        ]);
        $this->tenantapp->updateTenantRecords($request);
        if (!empty($request->file('avatar'))) {
            $image = Image::make($request->file('avatar'));
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $dir = 'images/avatar/';
            $avatar = '_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $image->save(public_path($dir.$avatar));
        } else {
            $avatar = 'avatar.png';
        }
        #Update tenant avatar
        $this->tenant->updateAvatar($avatar);
        session()->flash("success", "<strong>Success!</strong> Account changes saved.");
        return back();
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'current_password'=>'required',
            'password'=>'required|confirmed',
        ]);
        $tenant = Tenant::find(Auth::user()->id);
        if (Hash::check($request->current_password, $tenant->password)) {
            $tenant->password = bcrypt($request->password);
            $tenant->save();
            session()->flash("success", "<strong>Success!</strong> Password changed.");
            return back();
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Current password does not match our record. Try again.");
            return back();
        }
    }


    public function maintenance(){
        return view('tenant.maintenance');
    }

    public function maintenanceDetail($slug){
        $task = $this->task->getTask($slug);
        if(!empty($task)){
            return view('tenant.maintenance-detail',['task'=>$task]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }

    public function storeLeaveFrontendConversation(Request $request){
        $this->validate($request,[
            'comment'=>'required',
            'task'=>'required'
        ]);
        $this->taskfront->setNewFrontendConversation($request);
        session()->flash("success", "<strong>Success!</strong> Comment saved.");
        return back();
    }


    public function showMaintenanceRequestForm(){

       return view('tenant.add-new-maintenance-request',[
           'categories'=>$this->taskcategory->getAllTaskCategories(),
       ]);
    }


    public function storeNewMaintenanceRequest(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'category'=>'required',
            'priority'=>'required',
            'description'=>'required'
        ]);
        $this->maintenancerequest->setNewMaintenanceRequest($request);
        session()->flash("success", "<strong>Success!</strong> Your maintenance request is received.");
        return redirect()->route('maintenance');
    }

    public function notifications(){
        $this->tenantnotification->markAllAsRead();
        return view("tenant.notifications");
    }

    public function markAllAsRead(){
        $this->tenantnotification->markAllAsRead();
        return back();
    }
}
