<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ModuleManager extends Model
{
    use HasFactory;

    /*
     * Use-case methods
     */
    public function getAllModules(){
        return ModuleManager::orderBy('module_name', 'ASC')->get();
    }

    public function setNewModule(Request $request){
        $module = new ModuleManager();
        $module->module_name = $request->module_name;
        $module->save();
    }


}
