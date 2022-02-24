<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:manager');
        $this->tenant = new Tenant();
        $this->property = new Property();
    }


    public function dashboard(){

        return view('manager.home.index',[
            'tenants'=>$this->tenant->getAllCompanyTenants(),
            'properties'=>$this->property->getAllCompanyProperties(),
            'renewals'=>$this->tenant->getUpcomingRenewals()
        ]);
    }
}
