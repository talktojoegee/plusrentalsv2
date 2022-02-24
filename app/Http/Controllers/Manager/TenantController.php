<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LeaseRenewal;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:manager');
        $this->tenant = new Tenant();
        $this->leaserenewal = new LeaseRenewal();
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
