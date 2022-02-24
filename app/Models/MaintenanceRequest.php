<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequest extends Model
{
    use HasFactory;

    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getTaskCategory(){
        return $this->belongsTo(TaskCategory::class, 'category');
    }


    /*
     * Use-case methods
     */

    public function setNewMaintenanceRequest(Request $request){
        $maintenance = new MaintenanceRequest();
        $maintenance->ticket_no = date_format(now(),'ymdHi');
        $maintenance->title = $request->title ?? '';
        $maintenance->description = $request->description ?? '';
        $maintenance->tenant_id = Auth::user()->id;
        $maintenance->category = $request->category ?? '';
        $maintenance->priority = $request->priority ?? '';
        $maintenance->company_id = Auth::user()->company_id;
        $maintenance->slug = substr(sha1(time()),26,40);
        #Attachment
        $maintenance->save();
    }

    public function getAllCompanyMaintenanceRequests(){
        return MaintenanceRequest::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }
}
