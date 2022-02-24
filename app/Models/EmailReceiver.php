<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailReceiver extends Model
{
    use HasFactory;
    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getCompany(){
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function getMail(){
        return $this->belongsTo(Email::class, 'email_id');
    }

    /*
     * Use-case methods
     */

    public function setNewEmailReceivers(Request $request, $email, $tenant){
        $receiver = new EmailReceiver();
        $receiver->email_id = $email->id;
        $receiver->tenant_id = $tenant;
        //$receiver->email = $request->email;
        $receiver->company_id = $email->company_id;
        $receiver->save();
    }
}
