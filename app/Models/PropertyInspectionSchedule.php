<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyInspectionSchedule extends Model
{
    use HasFactory;

    public function getAttendedBy(){
        return $this->belongsTo(User::class, 'attended_by');
    }

    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }





    public function setPropertyInspectionShedule(Request $request, $company_id){

        $schedule = new PropertyInspectionSchedule();
        $schedule->property_id = $request->properti;
        $schedule->full_name = $request->full_name;
        $schedule->email = $request->email_address;
        $schedule->mobile_no = $request->mobile_no;
        $schedule->message = $request->message;
        $schedule->schedule_date = $request->schedule_date_time;
        $schedule->company_id = $company_id;
        $schedule->save();
    }

    public function getPropertyInspectionRequestByPropertyId($property_id){
        return PropertyInspectionSchedule::where('property_id', $property_id)->where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }
    public function getAllPropertyInspectionRequests(){
        return PropertyInspectionSchedule::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function assignUserToPropertyInspectionRequest(Request $request){
        $inspect = PropertyInspectionSchedule::find($request->inspectionId);
        $inspect->date_attended = $request->schedule_date;
        $inspect->attended_by = $request->assign_to;
        $inspect->save();
    }
    public function updatePropertyInspectionStatus(Request $request){
        $inspect = PropertyInspectionSchedule::find($request->inspection_id);
        $inspect->status = $request->status;
        $inspect->updated_at = now();
        $inspect->comment = $request->comment ?? '';
        $inspect->save();
    }

}
