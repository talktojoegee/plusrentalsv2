<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\TenantDomesticStaff;
use App\Models\TenantOccupant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OccupantController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:tenant');
        $this->occupant = new TenantOccupant();
        $this->staff = new TenantDomesticStaff();
    }


    public function occupants(){
        return view('tenant.my-occupants');
    }

    public function showAddNewOccupantForm(){
        return view('tenant.add-new-occupant');
    }

    public function storeNewTenantOccupant(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'relationship'=>'required'
        ]);
        $this->occupant->setNewTenantOccupant($request);
        session()->flash("success", "<strong>Success!</strong> New occupant saved.");
        return redirect()->route('my-occupants');
    }
    public function updateTenantOccupant(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'relationship'=>'required',
            'occupant'=>'required'
        ]);
        $occupant = $this->occupant->getTenantOccupantById($request->occupant);
        if(!empty($occupant)){
            if($occupant->tenant_id == Auth::user()->id){
                $this->occupant->updateTenantOccupant($request);
                session()->flash("success", "<strong>Success!</strong> Changes saved.");
                return redirect()->route('my-occupants');
            }else{
                session()->flash("error", "<strong>Ooops!</strong> This occupant is not associated with your account.");
                return redirect()->route('my-occupants');
            }
        }
    }
}
