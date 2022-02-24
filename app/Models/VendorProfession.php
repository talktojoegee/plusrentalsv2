<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VendorProfession as VProfessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProfession extends Model
{
    use HasFactory;


    /*
     * Use-case methods
     */

    public function getAllVendorProfessions(){
        return VProfessions::where('company_id', Auth::user()->company_id)->orderBy('profession_name', 'ASC')->get();
    }

    public function setVendorProfession(Request $request){
        $profession = new VProfessions();
        $profession->profession_name = $request->profession_name;
        $profession->company_id = Auth::user()->company_id;
        $profession->save();
    }

    public function editVendorProfession(Request $request){
        $profession = VProfessions::find($request->profession);
        $profession->profession_name = $request->profession_name;
        $profession->save();
    }



}
