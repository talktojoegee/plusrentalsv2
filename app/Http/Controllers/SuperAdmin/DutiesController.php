<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DutiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->theme = new Theme();
    }

    public function index(){
        return view('superadmin.dashboard');
    }
    public function getRoles(){
        return Role::orderBy('name', 'ASC')->get();
    }

    public function getPermissions(){
        return Permission::orderBy('name', 'ASC')->get();
    }
    public function manageRoles(){
        return view('superadmin.manage-roles', ['roles'=>$this->getRoles()]);
    }

    public function storeNewRole(Request $request){
        $this->validate($request, [
            'role_name'=>'required|unique:roles,name'
        ]);
        $role = new Role();
        $role->name = $request->role_name;
        $role->save();
        return view('manager.administration.partials._roles', ['roles'=>$this->getRoles()]);
    }

    public function storeNewPermission(Request $request){
        $this->validate($request, [
            'permission_name'=>'required|unique:permissions,name'
        ],[
            'permission_name.required'=>'Enter permission name',
            'permission_name.unique'=>'Permission is already taken'
        ]);
        $role = new Permission();
        $role->name = $request->permission_name;
        $role->save();
        session()->flash("success", "<strong>Success!</strong> Your new permission was added");
        return back();
    }

    public function editRole(Request $request){
        $this->validate($request, [
            'role'=>'required',
            'roleId'=>'required'
        ]);
        $role = Role::find($request->roleId);
        $role->name = $request->role ?? '';
        $role->save();
        session()->flash("success", "<strong>Success!</strong> Role changes saved.");
        return redirect()->route('manage-roles');
    }


    public function managePermissions(){
        return view('superadmin.manage-permissions', ['permissions'=>$this->getPermissions()]);
    }

    public function manageThemes(){
        $themes = $this->theme->getThemes();
        return view('superadmin.theme.manage-themes', ['themes'=>$themes]);
    }

    public function themeGalleryUpload(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'attachment'=>'required|image'
        ]);
        $this->theme->uploadNewTheme($request);
        session()->flash("success", "<strong>Success!</strong> Your new theme was uploaded.");
        return back();

    }
}
