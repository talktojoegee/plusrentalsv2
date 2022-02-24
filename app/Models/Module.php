<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Module extends Model
{
    use HasFactory;



    /*
     * Use-case methods
     */
    public function setNewModuleName(Request $request){
        $module = new Module();
        $module->module_name = $request->module_name;
        $module->slug = Str::slug($request->module_name).'-'.substr(sha1(time()),35,40);
        $module->save();
    }
    public function updateModuleName(Request $request){
        $module = Module::find($request->module);
        $module->module_name = $request->module_name;
        $module->slug = Str::slug($request->module_name).'-'.substr(sha1(time()),35,40);
        $module->save();
    }

    public function getAllModules(){
        return Module::orderBy('module_name', 'ASC')->get();
    }
}
