<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\TenantApplicant as TenantApp;
use Illuminate\Support\Facades\Auth;
class TenantApplicant extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','surname','gender','marital_status','email','mobile_no','address','residency_date', 'avatar', 'status',
                         'attachment', 'means_of_identification', 'leave_note', 'applied_by', 'created_at', 'updated_at', 'url', 'property_id', 'company_id'];



    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getAllCompanyPendingApplicants(){
        return TenantApp::where('status', 0)->where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }
    public function getAllCompanyApplicants(){
        return TenantApp::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function setNewTenantApplication(Request $request, $company_id){
        $data = [
            'first_name'=>$request->first_name,
            'surname'=>$request->surname,
            'gender'=>$request->gender ?? 1,
            'email'=>$request->email,
            'mobile_no'=>$request->mobile_no,
            'address'=>$request->address,
            'residency_date'=>$request->date_of_residency,
            'property_id'=>$request->property,
            'company_id'=>$company_id,
            'url'=>substr(sha1(time()),24,40)
        ];

         TenantApp::create($data);
    }
    public function updateTenantRecords(Request $request){
        $tenant = TenantApplicant::find(Auth::user()->tenant_app_id);
         $tenant->first_name = $request->first_name ?? '';
         $tenant->surname = $request->surname ?? '';
         $tenant->mobile_no = $request->mobile_no ?? '';
         $tenant->address = $request->address ?? '' ;
        $tenant->save();
    }

    public function getTenantApplicant($slug){
        return TenantApp::where('url', $slug)->first();
    }

    public function getApplicantById($id){
        return TenantApp::find($id);
    }


    public function getAllCompanyLeaseApplicationThisYear(){
        return TenantApp::whereYear('created_at', date('Y'))->where('company_id', Auth::user()->company_id)->count();
    }

    public function getAllCompanyLeaseApplicationLastMonth(){
        return TenantApp::whereMonth('created_at', date('m') -1 )->whereYear('created_at', date('Y'))->where('company_id', Auth::user()->company_id)->count();
    }
    public function getAllCompanyLeaseApplicationThisMonth(){
        return TenantApp::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('company_id', Auth::user()->company_id)->count();
    }

}
