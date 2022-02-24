<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyLease as PropertyLet;
use App\Models\Receipt;
use App\Models\Tenant;
use App\Models\TenantApplicant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyLease extends Model
{
    use HasFactory;

    public function __construct()
    {

    }

    public function getProperty()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getApplicant(){
        return $this->belongsTo(TenantApplicant::class, 'rental_id');
    }

    public function getLocation(){
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function getArea()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'rental_id');
    }

    public function getLeaseRenewals(){
        return $this->hasMany(LeaseRenewal::class, 'property_id');
    }



    /*
     * Use-case methods
     */
    public function setNewLeaseApplication(Request $request, $duration){
        $current = Carbon::now();
            $lease = new PropertyLet;
            $lease->rental_id = $request->applicant;
            $lease->property_id = $request->property;
            $lease->rent_amount = $request->rent_amount;
            $lease->start_date = $request->start_date;
            $lease->lease_frequency_id = $request->frequency;
            $lease->end_date = $current->addDays($duration);
            $lease->slug = substr(sha1(time()),24,40);
            $lease->company_id = Auth::user()->company_id;
            $lease->save();

    }

    public function getPropertyLeaseByPropertyId($id){
        return LeaseRenewal::where('property_id',$id);

    }


}
