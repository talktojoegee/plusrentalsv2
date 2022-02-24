<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\TenantDomesticStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomesticStaffController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:tenant');
        $this->staff = new TenantDomesticStaff();

    }

    public function domesticStaff(){
        return view('tenant.my-domestic-staff');
    }

    public function showAddNewDomesticStaffForm(){
        return view('tenant.add-new-domestic-staff');
    }

    public function storeNewTenantDomesticStaff(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'responsibility'=>'required'
        ]);
        $this->staff->setNewTenantDomesticStaff($request);
        session()->flash("success", "<strong>Success!</strong> New staff saved.");
        return redirect()->route('my-domestic-staff');
    }
    public function updateTenantDomesticStaff(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'responsibility'=>'required',
            'staff'=>'required'
        ]);
        $staff = $this->staff->getTenantDomesticStaffById($request->staff);
        if(!empty($staff)){
            if($staff->tenant_id == Auth::user()->id){
                $this->staff->updateTenantDomesticStaff($request);
                session()->flash("success", "<strong>Success!</strong> Changes saved.");
                return redirect()->route('my-domestic-staff');
            }else{
                session()->flash("error", "<strong>Ooops!</strong> This staff is not associated with your account.");
                return redirect()->route('my-domestic-staff');
            }
        }
    }


}
