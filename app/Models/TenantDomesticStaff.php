<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantDomesticStaff extends Model
{
    use HasFactory;






    /*
     * Use-case methods
     */

    public function setNewTenantDomesticStaff(Request $request){
        $staff = new TenantDomesticStaff();
        $staff->first_name = $request->first_name ?? '';
        $staff->last_name = $request->surname ?? '';
        $staff->email = $request->email ?? '';
        $staff->mobile_no = $request->mobile_no ?? '';
        $staff->occupation = $request->responsibility ?? '';
        $staff->comment = $request->comment ?? '';
        $staff->tenant_id = Auth::user()->id;
        $staff->save();
    }

    public function updateTenantDomesticStaff(Request $request){
        $staff = TenantDomesticStaff::find($request->staff);
        $staff->first_name = $request->first_name ?? '';
        $staff->last_name = $request->surname ?? '';
        $staff->email = $request->email ?? '';
        $staff->mobile_no = $request->mobile_no ?? '';
        $staff->occupation = $request->responsibility ?? '';
        $staff->comment = $request->comment ?? '';
        $staff->tenant_id = Auth::user()->id;
        $staff->save();
    }

    public function getTenantDomesticStaffById($id){
        return TenantDomesticStaff::find($id);
    }
}
