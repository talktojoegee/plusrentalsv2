<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LeaseFrequency;
use App\Models\LeaseRenewal;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:manager');
        $this->tenant = new Tenant();
        $this->leaserenewal = new LeaseRenewal();
        $this->property = new Property();
        $this->leasefrequency = new LeaseFrequency();
    }


    public function showNewTenantForm(){
        $properties = $this->property->getAllCompanyVacantProperties();
        $frequencies = $this->leasefrequency->getAllActiveFrequencies();
        return view('manager.tenants.add-new-tenant',['properties'=>$properties, 'frequencies'=>$frequencies]);
    }
    public function getAllTenants(){
        $tenants =  $this->tenant->getAllCompanyTenants();
        if(!empty($tenants)){
            return view('manager.tenants.index', ['tenants'=>$tenants]);
        }else{
            return back();
        }
    }


    public function getTenant($slug){
        $tenant = $this->tenant->viewCompanyTenant($slug);
        if(!empty($tenant)){

            return view('manager.tenants.view-tenant', [
                'tenant'=>$tenant,
                'leaserenewals'=>$this->leaserenewal->getAllTenantLeaseRenewalsByTenantId($tenant->id)
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }

}
