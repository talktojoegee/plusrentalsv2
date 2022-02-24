<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleLease extends Model
{
    use HasFactory;


    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getScheduledBy(){
        return $this->belongsTo(User::class, 'scheduled_by');
    }

    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }


    /*
     * Use-case methods
     */

    /*public function setNewLeaseSchedule(Invoice $invoice){
        $schedule = new ScheduleLease();
       // $schedule->tenant_id = $request->tenant;
        $schedule->property_id = $invoice->property;
        $schedule->trans_ref = $invoice->trans_ref;
        $schedule->scheduled_by = 1; //Auth::user()->id;
        //$schedule->start_date = $request->start_date;
        //$schedule->end_date = $request->end_date;
        $schedule->status = 0; //pending
        $schedule->slug = substr(sha1(time()),32,40);
        $schedule->save();
    }*/



    public function updateLeaseSchedule(Request $request, $frequency)
    {
        $key = "key_" . substr(sha1(time()), 21, 40);
        $current = Carbon::now();
        $end_date = $current->addDays($frequency->duration);

        $schedule = ScheduleLease::find($request->schedule);
        $schedule->status = 1; //approved||started
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $end_date;
        $schedule->save();
        $tenantId = $schedule->tenant_id;

        #Update tenant record
        $tenant = Tenant::find($tenantId);
        $tenant->start_date = $request->start_date;
        $tenant->end_date = $end_date;
        //if (empty($tenant->active_subscription_key)) {
            $tenant->active_subscription_key = $key;
       // }
        $tenant->save();
        #Lease renewal
        if ($schedule->status == 1) {
            $this->createNewLeaseRenewal($tenantId, $tenant, $request->start_date,$end_date, $key);
            /*$renewal = LeaseRenewal::where('active_subscription_key', $tenant->active_subscription_key)->first();
            $renewal->tenant_id = $tenantId;
            $renewal->property_id = $tenant->property_id;
            //$renewal->active_subscription_key = $key;
            $renewal->start_date = $request->start_date;
            $renewal->end_date = $current->addDays($frequency->duration);
            $renewal->save();*/
        }/*else{
            $renewal = new LeaseRenewal();
            $renewal->tenant_id = $tenantId;
            $renewal->property_id = $tenant->property_id;
            $renewal->active_subscription_key = $key;
            $renewal->start_date = $request->start_date;
            $renewal->end_date = $current->addDays($frequency->duration);
            $renewal->save();
        }*/


    }

    public function getAllScheduleLeases(){
        return ScheduleLease::orderBy('id', 'DESC')->get();
    }

    public function getLeaseScheduleBySlug($slug){
        return ScheduleLease::where('slug', $slug)->first();
    }

    public function createNewLeaseRenewal($tenantId, $tenant, $start_date, $end_date, $key){
        $renewal = new LeaseRenewal();
        $renewal->tenant_id = $tenantId;
        $renewal->property_id = $tenant->property_id;
        $renewal->active_subscription_key = $key;
        $renewal->start_date = $start_date;
        $renewal->end_date = $end_date;
        $renewal->company_id = Auth::user()->company_id;
        $renewal->save();
    }
}
