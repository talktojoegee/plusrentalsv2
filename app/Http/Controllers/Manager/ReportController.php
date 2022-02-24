<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->property = new Property();
        $this->location = new Location();
        $this->tenant = new Tenant();
    }

    public function propertyReport()
    {
        return view('manager.report.property',
            [ 'status'=>0,
                'locations'=>$this->location->getLocations()
                ]);
    }

    public function generatePropertyReport(Request $request){
        $this->validate($request,[
            'start_date'=>'required',
            'location'=>'required',
            'end_date'=>'required',
        ],[
            'start_date.required'=>'Set a start time',
            'end_date.required'=>'Set end time',
            'location.required'=>'Choose location',
        ]);
        $location = $this->location->getLocationById($request->location);

        $location_id = null;
        if(!empty($location)){
            $location_id = $location->id;
        }else{
            $location_id = 0;
        }
        $properties = $this->property->getAllCompanyPropertyReport($request, $location_id);
        return view('manager.report.property',[
            'status'=>1,
            'properties'=>$properties,
            'start'=>$request->start_date,
            'end'=>$request->end_date,
            'locations'=>$this->location->getLocations(),
            'loc'=>$location,
            'section'=>'general'

        ]);
    }
    public function generatePropertyReportByStatus(Request $request){
        $this->validate($request,[
            'status'=>'required',
            'location'=>'required',
        ],[
            'status.required'=>'Choose status',
            'location.required'=>'Choose location',
        ]);
        $location = $this->location->getLocationById($request->location);

        $location_id = null;
        if(!empty($location)){
            $location_id = $location->id;
        }else{
            $location_id = 0;
        }
        $properties = $this->property->getAllCompanyPropertyReportByStatus($request, $location_id);
        return view('manager.report.property',[
            'status'=>1,
            'properties'=>$properties,
            'start'=>$request->start_date,
            'end'=>$request->end_date,
            'locations'=>$this->location->getLocations(),
            'loc'=>$location,
            'section'=>'status',
            'stat'=>$request->status, //selected status
        ]);
    }

    public function tenantReport()
    {
        return view('manager.report.tenant',
            [ 'status'=>0
            ]);
    }

    public function generateTenantReport(Request $request){
        $this->validate($request,[
            'start_date'=>'required',
            'end_date'=>'required',
        ],[
            'start_date.required'=>'Set a start time',
            'end_date.required'=>'Set end time'
        ]);
        $tenants = $this->tenant->getAllCompanyTenantReport($request);
        return view('manager.report.tenant',[
            'status'=>1,
            'tenants'=>$tenants,
            'start'=>$request->start_date,
            'end'=>$request->end_date,
            'section'=>'general'

        ]);
    }
    public function generateTenantReportByStatus(Request $request){
        $this->validate($request,[
            'status'=>'required'
        ],[
            'status.required'=>'Choose status',
        ]);

        $tenants = $this->tenant->getAllCompanyTenantReportByStatus($request);
        return view('manager.report.tenant',[
            'status'=>1,
            'tenants'=>$tenants,
            'start'=>$request->start_date,
            'end'=>$request->end_date,
            'section'=>'status',
            'stat'=>$request->status, //selected status
        ]);
    }

}
