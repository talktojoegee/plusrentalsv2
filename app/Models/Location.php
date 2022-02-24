<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    public function getLocationAreas(){
        return $this->hasMany(Area::class, 'location_id');
    }

    /*
     * Use-case methods
     */
    public function getLocations(){
        return Location::orderBy('location_name', 'ASC')->get();
    }
    public function getLocationById($id){
        return Location::find($id);
    }


    public function setLocation(Request $request){
        $location = new Location();
        $location->location_name = $request->location_name;
        $location->slug = Str::slug($request->location_name);
        $location->save();
    }

    public function editLocation(Request $request){
        $location = Location::find($request->location);
        $location->location_name = $request->location_name;
        $location->save();
    }
}
