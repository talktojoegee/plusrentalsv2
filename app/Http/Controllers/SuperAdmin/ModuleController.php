<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleManager;
use App\Models\ModulePermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->module = new Module();
        $this->modulepermission = new ModulePermission();
        $this->permission = new Permission();
    }

    public function showAppModules(){
        return view('superadmin.modules',[
            'modules'=>$this->module->getAllModules(),
            'permissions'=>$this->permission->getAllPermissions()
            ]);
    }
    public function showModuleManager(){
        return view('superadmin.module-manager',[
            'modules'=>$this->module->getAllModules(),
            'permissions'=>$this->permission->getAllPermissions(),
            'modulepermissions'=>$this->modulepermission->getAllModulePermissions()
            ]);
    }

    public function setNewModule(Request $request){
        $this->validate($request,[
            'module_name'=>'required|unique:modules,module_name'
        ],[
            'module_name.required'=>'Enter module name',
            'module_name.unique'=>'Module name already taken.'
        ]);
        $this->module->setNewModuleName($request);
        session()->flash("success", "<strong>Success!</strong> Module name registered.");
        return back();
    }

    public function updateModule(Request $request){
        $this->validate($request,[
            'module_name'=>'required|unique:modules,module_name',
            'module'=>'required'
        ],[
            'module_name.required'=>'Enter module name',
            'module_name.unique'=>'Module name already taken.'
        ]);
        $this->module->updateModuleName($request);
        session()->flash("success", "<strong>Success!</strong> Your changes were saved.");
        return back();
    }

    public function setNewModulePermission(Request $request){
        $this->validate($request, [
            'module'=>'required',
            //'permission'=>'required',
            //'permission.*'=>'required|array'
        ]);
        foreach($request->permission as $permission){
            $this->modulepermission->setNewModulePermission($request->module, $permission);
        }
        session()->flash("success", "<strong>Success!</strong> New module-permission assigned");
        return back();
    }

    public function updateModulePermission(Request $request){
        $this->validate($request, [
            'module'=>'required',
            'modperm'=>'required',
            //'permission.*'=>'required|array'
        ]);
            $this->modulepermission->updateModulePermission($request);
        session()->flash("success", "<strong>Success!</strong> Your changes were saved.");
        return back();
    }
}
