<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\CareTaker as CTaker;

class CareTaker extends Model
{
    use HasFactory;





    /*
     *Use-case methods
     */

    public function setCareTaker(Request $request){
        $taker = new CTaker();
        $taker->first_name = $request->first_name;
        $taker->surname = $request->surname ?? '';
        $taker->email = $request->email ?? '';
        $taker->property_id = $request->property ?? '';
        $taker->rental_owner_id = $request->rental_owner ?? '';
        $taker->mobile_no = $request->mobile_no ?? '' ;
        $taker->address = $request->address ?? '';
        $taker->slug = substr(sha1(time()), 23,40);
        $taker->save();
    }

    public function editCareTaker(Request $request){
        $taker = CTaker::find($request->caretaker);
        $taker->first_name = $request->first_name ?? '';
        $taker->surname = $request->surname ?? '';
        $taker->property_id = $request->property ?? '';
        $taker->rental_owner_id = $request->rental_owner ?? '';
        $taker->mobile_no = $request->mobile_no ?? '' ;
        $taker->address = $request->address ?? '';
        $taker->save();
    }

    public function getCareTakers(){
        $takers = CTaker::orderBy('id', 'DESC')->get();
        return $takers;
    }

    public function getCareTakersByPropertyId(Request $request){
        $takers = CTaker::where('property_id', $request->property)->get();
        return $takers;
    }

    public function getCareTakersByRentalOwnerId(Request $request){
        $takers = CTaker::where('rental_owner_id', $request->rental_owner)->get();
        return $takers;
    }

    public function getCareTakerBySlug($slug){
        $taker = CTaker::find($slug)->first();
        return $taker;
    }




}
