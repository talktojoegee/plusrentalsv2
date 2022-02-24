<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyPaymentIntegration extends Model
{
    use HasFactory;



    /*
     * Use-case methods
     */
    public function setNewCompanyPaymentIntegration(Request $request){
        $integration = CompanyPaymentIntegration::where('company_id', Auth::user()->company_id)->where('type',1)->first();
        if(!empty($integration)){
            $integration->ps_public_key = $request->public_key;
            $integration->ps_secret_key = $request->secret_key;
            $integration->type = 1;
            $integration->company_id = Auth::user()->company_id;
            $integration->save();
        }else{
            $new_integration = new CompanyPaymentIntegration();
            $new_integration->ps_public_key = $request->public_key;
            $new_integration->ps_secret_key = $request->secret_key;
            $new_integration->type = 1; //live
            $new_integration->company_id = Auth::user()->company_id;
            $new_integration->save();
        }
    }

    public function getCompanyPaymentIntegration($company_id){
        return CompanyPaymentIntegration::where('company_id', $company_id)->first();
    }
}
