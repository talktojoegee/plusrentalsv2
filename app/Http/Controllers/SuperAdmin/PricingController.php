<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function managePricingNFeatures(){
        return view('superadmin.pricing-n-features');
    }


}
