<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ModulePermission extends Model
{
    use HasFactory;

    public function getPermission(){
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function getModule(){
        return $this->belongsTo(Module::class, 'module_id');
    }


    /*
     * Use-case methods
     */
    public function setNewModulePermission($mod, $permission){
        $module = new ModulePermission();
        $module->permission_id = $permission;
        $module->module_id = $mod;
        $module->save();
    }

    public function updateModulePermission(Request $request){
        $module = ModulePermission::find($request->modperm);
        $module->permission_id = $request->permission;
        $module->module_id = $request->module;
        $module->save();
    }

    public function getAllModulePermissions(){
        return ModulePermission::all();
    }
}
