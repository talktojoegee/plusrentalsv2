<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Vendor as VModel;
use Illuminate\Support\Facades\Auth;

class Vendor extends Model
{
    use HasFactory;


    public function getVendorCategory(){
        return $this->belongsTo(VendorProfession::class, 'profession_id');
    }


    /*
     * Use-case methods
     */
    public function setVendor(Request $request, $default_account){
        $vendor = new VModel();
        $vendor->profession_id = $request->category;
        $vendor->first_name = $request->first_name ?? '';
        $vendor->surname = $request->surname ?? '';
        $vendor->vendor_type = $request->vendor_type ?? '';
        $vendor->company_name = $request->company_name ?? '';
        $vendor->mobile_no = $request->mobile_no ?? '';
        $vendor->email = $request->email ?? '';
        $vendor->address = $request->address ?? '';
        //$vendor->website = $request->website ?? '';
        $vendor->slug = substr(sha1(time()), 24,40);
        $vendor->glcode = $request->default_account == 1 ? $default_account->glcode : $request->vendor_account;
        $vendor->company_id = Auth::user()->company_id;
        $vendor->save();
    }

    public function editVendor(Request $request, $default_account){
        $vendor = VModel::find($request->vendor);
        $vendor->profession_id = $request->category ?? '';
        $vendor->first_name = $request->first_name ?? '';
        $vendor->surname = $request->surname ?? '';
        $vendor->vendor_type = $request->vendor_type ?? '';
        $vendor->company_name = $request->company_name ?? '';
        $vendor->mobile_no = $request->mobile_no ?? '';
        $vendor->address = $request->address ?? '';
        $vendor->glcode = $request->default_account == 1 ? $default_account->glcode : $request->vendor_account;
        $vendor->save();
    }

    public function getAllVendors(){
        $vendors = VModel::orderBy('id', 'DESC')->get();
        return $vendors;
    }
    public function getAllCompanyVendors(){
        $vendors = VModel::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
        return $vendors;
    }

    public function getVendorBySlug($slug){
        $vendor = VModel::where('slug', $slug)->first();
        return $vendor;
    }

    public function getVendorById($id){
        return Vendor::find($id);
    }




}
