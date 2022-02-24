<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Area extends Model
{
    use HasFactory;






    /*
     * Use-case methods
     */

    public function getAllAreas(){
        $areas = Area::orderBy('area_name', 'ASC')->get();
        return $areas;
    }


    public function setArea(Request $request){
        $area = new Area();
        $area->area_name = $request->area_name;
        $area->slug = Str::slug($request->area_name);
        $area->location_id = $request->location;
        $area->save();
    }


    public function editArea(Request $request){
        $area = Area::find($request->area);
        $area->area_name = $request->area_name;
        $area->location_id = $request->location;
        $area->save();
    }


}
