<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LeaseRenewal extends Model
{
    use HasFactory;


    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }


     /*
     * Use-case method
     */

    public function  renewTenantLease($tenant_id, $company_id, $property_id, $key, $start_date, $end_date ){
        $renew = new LeaseRenewal();
        $renew->tenant_id = $tenant_id;
        $renew->property_id = $property_id;
        $renew->active_subscription_key = $key;
        $renew->start_date = $start_date;
        $renew->end_date = $end_date;
        $renew->company_id = $company_id;
        $renew->save();
    }

    public function getAllMyLeases($id){
        return LeaseRenewal::where('tenant_id', $id)->orderBy('id', 'DESC')->get();
    }

    public function getAllTenantLeaseRenewalsByTenantId($tenant_id){
        return LeaseRenewal::where('tenant_id', $tenant_id)->where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function getPropertyLeaseByPropertyId($id){
        return LeaseRenewal::where('property_id',$id)->orderBy('id', 'DESC')->get();

    }


}
