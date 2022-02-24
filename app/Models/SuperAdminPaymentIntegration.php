<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdminPaymentIntegration extends Model
{
    use HasFactory;


    /*
     * Use-case methods
     */

    public function getSuperAdminPaymentIntegrationObj(){
        return SuperAdminPaymentIntegration::first();
    }
}
