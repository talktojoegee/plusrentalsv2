<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;

    public function getLocation(){
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function getArea(){
        return $this->belongsTo(Area::class, 'area_id');
    }




    /*
     * Use-case methods
     */

    public function setNewCompany(){
        $current = Carbon::now();
        $url = substr(sha1(time()),29,40);
        $key = "key_".substr(sha1(time()),23,40);
        $company = new Company();
        $company->slug = $url;
        $company->start_date = now();
        $company->end_date = $current->addDays(14);
        $company->active_subscription_key = $key;
        $company->no_of_units = 5; //for free trial
        $company->email = 'hello@gmail.com';
        $company->save();
        return $company;
    }

    public function updateCompanyDetails(Request $request){
        $update = Company::find(Auth::user()->company_id);
        $update->company_name = $request->company_name;
        $update->mobile_no = $request->mobile_no;
        $update->phone_no = $request->phone_no;
        $update->location_id = $request->location;
        $update->area_id = $request->area;
        $update->city = $request->city;
        $update->address_1 = $request->address_1;
        $update->address_2 = $request->address_2;
        $update->post_code = $request->post_code;
        $update->website = $request->website;
        $update->tagline = $request->tagline;
        $update->email = $request->email ?? '';
        $update->save();
    }

    public function uploadLogo(Request $request){
        if ($request->hasFile('logo')) {
                $extension = $request->logo->getClientOriginalExtension();
                $filename = 'logo'.'_'. date('Ymd') . '.' . $extension;
                $dir = 'assets/drive/';
                $request->logo->move(public_path($dir), $filename);
                $company = Company::find(Auth::user()->company_id);
                $company->logo = $filename;
                $company->save();

        }
    }

    public function uploadFavicon(Request $request){
        if ($request->hasFile('favicon')) {
            $extension = $request->favicon->getClientOriginalExtension();
            $filename = 'favicon'.'_'. date('Ymd') . '.' . $extension;
            $dir = 'assets/drive/';
            $request->favicon->move(public_path($dir), $filename);
            $company = Company::find(Auth::user()->company_id);
            $company->favicon = $filename;
            $company->save();

        }
    }
    public function updateCompanySubscription($company_id, $key,$units, $plan, $start_date, $end_date){
        $company = Company::find($company_id);
        $company->active_subscription_key = $key;
        $company->start_date = now();
        $company->end_date = $end_date;
        $company->no_of_units += $units; //temporarily
        $company->paid = 1; //paid
        $company->plan_id = $plan;
        $company->save();
    }
    public function getCompanyByCompanyId($id){
        return Company::find($id);
    }

    public function updateSenderId(Request $request){
        $tenant = Company::find(Auth::user()->company_id);
        $tenant->sender_id = $request->sender_id ?? '';
        $tenant->save();
    }

    public function updateTenantPaymentIntegration(Request $request){
        $tenant = Company::find(Auth::user()->company_id);
        $tenant->secret_key = $request->secret_key ?? Auth::user()->getUserCompany->secret_key;
        $tenant->public_key = $request->public_key ?? Auth::user()->getUserCompany->public_key;
        $tenant->save();
    }
}
