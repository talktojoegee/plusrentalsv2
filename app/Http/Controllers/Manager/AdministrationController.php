<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdministrationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->user = new User();
        $this->role = new Role();
        $this->theme = new Theme();
    }


    public function manageUsers(){
        return view('manager.administration.manage-users', ['users'=>$this->user->getAllCompanyUsers()]);
    }

    public function showAddNewUserForm(){
        return view('manager.administration.add-new-user');
    }

    public function storeNewUser(Request $request){
        $this->validate($request, [
            'first_name'=>'required',
            'email'=>'required|unique:users,email',
            'surname'=>'required',
            'address'=>'required',
            'mobile_no'=>'required',
        ]);
        $this->user->setNewUser($request);
        session()->flash("success", "<strong>Success!</strong> New user added to ".config('app.name'));
        return back();
    }

    public function viewProfile($slug){
        $user = $this->user->getUserBySlug($slug);
        if(!empty($user)){
            return view('manager.administration.profile',['user'=>$user]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
           'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'position'=>'required',
            'address'=>'required'
        ],[
            'first_name.required'=>"Enter your first name",
            'surname.required'=>"Enter your surname",
            'mobile_no.required'=>"Enter your mobile number",
            'position.required'=>"Enter your position",
            'address.required'=>"Enter your address"
        ]);
        $this->user->updateProfile($request);
        if(isset($request->avatar)){
            $this->user->updateAvatar($request);
        }
        session()->flash("success", "<strong>Success!</strong> Your changes were saved.");
        return back();

    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'current_password'=>'required',
            'password'=>'required|confirmed'
        ]);
        $user = $this->user->getUserById(Auth::user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            $message = "<div class='alert alert-outline-primary alert-pills' role='alert'>
                        <span class='badge badge-pill badge-danger'> Success! </span>
                        <span class='alert-content'> Password changed.</span>
                    </div>";
            session()->flash("success", $message);
            return back();
        }else{
            $message = "<div class='alert alert-outline-warning alert-pills' role='alert'>
                        <span class='badge badge-pill badge-danger'> Ooops! </span>
                        <span class='alert-content'> Current password does not match our record. Try again.</span>
                    </div>";
            session()->flash("error", $message);
            return back();
        }
    }



}
