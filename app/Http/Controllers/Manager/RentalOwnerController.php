<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\RentalOwner;
use Illuminate\Http\Request;

class RentalOwnerController extends Controller
{
    public function __construct(){
        $this->middleware('auth:manager');
    }

    public function showRentalOwners(){
        $rentals = RentalOwner::orderBy('id', 'DESC')->get();
        return view('manager.rental-owner.index',['rentals'=>$rentals]);
    }


    public function showNewRentalOwnerForm(){
        return view('manager.rental-owner.add-new-rental-owner');
    }

    public function storeNewRentalOwnerForm(Request $request){

        $data = [];
        $password = bcrypt(substr(sha1(time()),32,40));
        $slug = substr(sha1(time()),27,40);
        if($request->ownership_type == 1){
            $this->validate($request,[
                'first_name'=>'required',
                'surname'=>'required',
                'email'=>'required|email|unique:rental_owners,email',
                'mobile_no'=>'required',
                'address'=>'required'
            ]);
            $data = [
                'first_name'=>$request->first_name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'mobile_no'=>$request->mobile_no,
                'address'=>$request->address,
                'ownership_type'=>$request->ownership_type,
                'password'=>$password,
                'avatar'=>'avatar.png',
                'title'=>$request->title,
                'slug'=>$slug,
                'marital_status'=>$request->marital_status
            ];
        }else if($request->ownership_type == 2){
            $this->validate($request,[
                'company_name'=>'required',
                'official_phone_no'=>'required',
                'official_email'=>'required|email|unique:rental_owners,email',
                'office_address'=>'required'
            ]);
            $data = [
                'company_name'=>$request->company_name,
                'email'=>$request->official_email,
                'mobile_no'=>$request->official_phone_no,
                'address'=>$request->office_address,
                'ownership_type'=>$request->ownership_type,
                'password'=>$password,
                'avatar'=>'avatar.png',
                'slug'=>$slug
            ];
        }
        $rental = new RentalOwner;
        $rental->create($data);
        session()->flash("success", "<strong>Great!</strong> New rental owner registered successfully.");
        return back();
    }
    public function updateRentalOwnerForm(Request $request){

        $data = [];

        if($request->ownership_type == 1){
            $this->validate($request,[
                'first_name'=>'required',
                'surname'=>'required',
                'email'=>'required|email',
                'mobile_no'=>'required',
                'address'=>'required'
            ]);
            $data = [
                'first_name'=>$request->first_name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'mobile_no'=>$request->mobile_no,
                'address'=>$request->address,
                'ownership_type'=>$request->ownership_type,
                'avatar'=>'avatar.png',
                'title'=>$request->title,
                'marital_status'=>$request->marital_status
            ];
        }else if($request->ownership_type == 2){
            $this->validate($request,[
                'company_name'=>'required',
                'official_phone_no'=>'required',
                'official_email'=>'required',
                'office_address'=>'required'
            ]);
            $data = [
                'company_name'=>$request->company_name,
                'email'=>$request->official_email,
                'mobile_no'=>$request->official_phone_no,
                'address'=>$request->office_address,
                'ownership_type'=>$request->ownership_type,
                'avatar'=>'avatar.png',
            ];
        }
        $rental = RentalOwner::find($request->owner);
        $rental->update($data);
        session()->flash("success", "<strong>Great!</strong> Rental owner changes save.");
        return back();
    }

    public function viewRentalDetail($slug){
        $rental = RentalOwner::where('slug', $slug)->first();
        if(!empty($rental)){
            return view('manager.rental-owner.view-rental-owner',['rental'=>$rental]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
}
