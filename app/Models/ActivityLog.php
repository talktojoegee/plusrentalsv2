<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;





    /*
     * Use-case methods
     */

    public function setActivityLog(Request $request){
        $activity = new ActivityLog();
        //$activity->user_id = 1; //Auth::user()->id;
        $activity->log_date = now();
        $activity->activity = $request->activity;
        $activity->property_id = $request->property ?? '';
        $activity->tenant_id = $request->tenant ?? '';
        $activity->rental_owner_id = $request->rental_owner ?? '';
        $activity->care_taker_id = $request->care_taker ?? '';
        $activity->save();
    }


    public function getAllActivityLogs(){
        $activities = ActivityLog::orderBy('id', 'DESC')->get();
        return $activities;
    }

    public function getActivityLogsByTenantId($id){
        $activities = ActivityLog::where('tenant_id', $id)->orderBy('id', 'DESC')->get();
        return $activities;
    }

    public function getActivityLogsByPropertyId($id){
        $activities = ActivityLog::where('property_id', $id)->orderBy('id', 'DESC')->get();
        return $activities;
    }

    public function getActivityLogsByRentalOwnerId($id){
        $activities = ActivityLog::where('rental_owner_id', $id)->orderBy('id', 'DESC')->get();
        return $activities;
    }
}
