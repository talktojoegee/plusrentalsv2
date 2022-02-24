<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantOccupant extends Model
{
    use HasFactory;




    /*
     * Use-case methods
     */

    public function setNewTenantOccupant(Request $request){
        $occupant = new TenantOccupant();
        $occupant->title = $request->title ?? '';
        $occupant->first_name = $request->first_name ?? '';
        $occupant->last_name = $request->surname ?? '';
        $occupant->email = $request->email ?? '';
        $occupant->mobile_no = $request->mobile_no ?? '';
        $occupant->relationship = $request->relationship ?? '';
        $occupant->comment = $request->comment ?? '';
        $occupant->tenant_id = Auth::user()->id;
        $occupant->save();
    }

    public function updateTenantOccupant(Request $request){
        $occupant = TenantOccupant::find($request->occupant);
        $occupant->title = $request->title ?? '';
        $occupant->first_name = $request->first_name ?? '';
        $occupant->last_name = $request->surname ?? '';
        $occupant->email = $request->email ?? '';
        $occupant->mobile_no = $request->mobile_no ?? '';
        $occupant->relationship = $request->relationship ?? '';
        $occupant->comment = $request->comment ?? '';
        $occupant->tenant_id = Auth::user()->id;
        $occupant->save();
    }

    public function getTenantOccupantById($id){
        return TenantOccupant::find($id);
    }
}
