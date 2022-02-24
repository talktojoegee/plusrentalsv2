<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant as Tent;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Tenant extends Authenticatable
{
    use HasFactory, Notifiable;


    public function getApplicant(){
        return $this->belongsTo(TenantApplicant::class, 'tenant_app_id');
    }

    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getPropertyFeatures(){
        return $this->belongsTo(PropertyFeature::class, 'property_id');
    }


    public function getTenantInvoices(){
        return $this->hasMany(Invoice::class, 'tenant_id')->orderBy('id', 'DESC');
    }

    public function getTenantReceipts(){
        return $this->hasMany(Receipt::class, 'tenant_id')->orderBy('id', 'DESC');
    }

    public function getAllMyLeases(){
        return $this->belongsTo(LeaseRenewal::class, 'tenant_id');
    }

    public function getTenantOccupants(){
        return $this->hasMany(TenantOccupant::class, 'tenant_id');
    }

    public function getTenantDomesticStaff(){
        return $this->hasMany(TenantDomesticStaff::class, 'tenant_id');
    }

    public function getAllTenantStartedMaintenanceRequests(){
        return $this->hasMany(Task::class, 'tenant_id')->whereIn('status',[1,2,3]);
    }

    public function getAllTenantCompletedMaintenanceRequests(){
        return $this->hasMany(Task::class, 'tenant_id')->where('status',4);
    }
    public function getAllTenantMaintenanceRequests(){
        return $this->hasMany(MaintenanceRequest::class, 'tenant_id');
    }

    public function getAllUnreadTenantNotifications(){
        return $this->hasMany(TenantNotification::class, 'tenant_id')->where('is_read',0);
    }

    public function getAllTenantNotifications(){
        return $this->hasMany(TenantNotification::class, 'tenant_id')->orderBy('id','DESC');
    }



    /*
     * Use-case methods
     */

    public function getTenantAllocatedProperty(){
        return Property::find(Auth::user()->property_id);
    }

    public function getTenants(/*$status = null*/){
        return Tenant::orderBy('id', 'DESC')/*->where('status', $status)*/->get();

    }

    public function viewTenant($slug){
        return Tenant::where('slug', $slug)->first();

    }
    public function viewCompanyTenant($slug){
        return Tenant::where('slug', $slug)->where('company_id', Auth::user()->company_id)->first();

    }

    public function getTenantById($id){
        return Tenant::find($id);

    }

    public function getTenantByApplicantId($id){
        return Tenant::where('tenant_app_id',$id)->first();

    }

    public function getAllCompanyTenants(){
        return Tenant::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function getTenantByPropertyId($id){
        return Tenant::where('property_id', $id)->first();

    }

    public function evictTenant(Request $request){
        $tenant = Tenant::find($request->tenant);
        $tenant->status = 3; //tenant evicted
        $tenant->account_status = 2; //inactive
        $tenant->evicted_by = Auth::user()->id;
        $tenant->date_evicted = $request->eviction_date;
        $tenant->eviction_comment = $request->comment;
        $tenant->save();
    }

    public function markRentAsExpired(Request $request){
        $tenant = Tenant::find($request->tenant);
        $tenant->status = 2; //rent expired
        $tenant->save();
    }

    public function updateTenantLease($tenant, $property, $key, $start, $end){
        $tenant = Tenant::find($tenant);
        $tenant->property_id = $property;
        $tenant->active_subscription_key = $key;
        $tenant->start_date = $start;
        $tenant->end_date = $end;
        $tenant->save();
    }


    public function updateAvatar($filename){
        $avatar = Tenant::find(Auth::user()->id);
        $avatar->avatar = $filename ?? '';
        $avatar->save();
    }

    public function getUpcomingRenewals(){
        $current = Carbon::now();
        $startDate = $current->createFromFormat('Y-m-d','2019-10-01');
        $endDate = $current->createFromFormat('Y-m-d','2019-10-30');
        return Tenant::where('company_id', Auth::user()->company_id)->whereBetween('end_date', [$current, $current->parse()->addMonths(6)])->get();
    }

    public function getAllCompanyTenantReport(Request $request){
        $start = $request->start_date;
        $end = $request->end_date;
            return Tenant::where('company_id', Auth::user()->company_id)
                ->whereBetween('created_at', [$start, $end])
                ->orderBy('id', 'DESC')
                ->get();


    }
    public function getAllCompanyTenantReportByStatus(Request $request){
            return Tenant::where('company_id', Auth::user()->company_id)
                ->where('status', $request->status)
                ->orderBy('id', 'DESC')
                ->get();

    }




}
