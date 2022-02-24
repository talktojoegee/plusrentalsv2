<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    use HasFactory;


    public function getServiceGl(){
        return $this->belongsTo(ChartOfAccount::class, 'glcode', 'glcode');
    }

    /*
     * Use-case methods
     */

    public function getAllServices(){
        return Service::orderBy('service_name', 'ASC')->get();
    }
    public function setNewService(Request $request){
        $service = new Service();
        $service->user_id = Auth::user()->id;
        $service->service_name = $request->service_name ?? '';
        $service->charge_type = $request->charge_type ?? 1;
        $service->charge_value = $request->charge_value ?? 0;
        $service->glcode = $request->glcode ?? 0;
        $service->company_id = Auth::user()->company_id;
        $service->save();
    }

    public function updateService(Request $request){
        $service = Service::find($request->service);
        $service->service_name = $request->edit_service_name ?? '';
        $service->charge_type = $request->edit_charge_type ?? 1;
        $service->charge_value = $request->edit_charge_value ?? 0;
        $service->glcode = $request->edit_glcode ?? 0;
        $service->save();
    }
}
