<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaseFrequency extends Model
{
    use HasFactory;




    /*
     * Use-case methods
     */

    public function getAllActiveFrequencies(){
        $frequencies = LeaseFrequency::where('status',1)->orderBy('duration', 'ASC')->get(); //active frequencies
        return $frequencies;
    }

    public function getAllFrequencies(){
        $frequencies = LeaseFrequency::orderBy('duration', 'ASC')->get(); //all frequencies
        return $frequencies;
    }

    public function setFrequency(Request $request){
        $frequency = new LeaseFrequency();
        $frequency->frequency_name = $request->frequency_name;
        $frequency->duration = $request->duration;
        $frequency->company_id = Auth::user()->company_id;
        $frequency->save();
    }

    public function editFrequency(Request $request){
        $frequency = LeaseFrequency::find($request->frequency);
        $frequency->frequency_name = $request->frequency_name;
        $frequency->duration = $request->duration;
        $frequency->save();
    }

    public function getLeaseFrequencyById($id){
        return LeaseFrequency::find($id);
    }





}
