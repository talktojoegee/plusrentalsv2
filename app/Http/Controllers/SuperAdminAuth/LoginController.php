<?php

namespace App\Http\Controllers\SuperAdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function adminLogin(Request $request){
        /*return dd($request->all());*/
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required'
        ],
            [
                'email.required'=>'Enter your registered email.',
                'password.required'=>'Enter valid password for this account.'
            ]);
        if(Auth::guard('admin')->attempt([
            'email'=>$request->email,
            'password'=>$request->password, 'account_status'=>1],
            $request->remember)){
            session()->flash("success", "<strong>Notice: </strong> You're advised to complete your profile");
            return redirect()->route('duties');
        }else{
            session()->flash("error", "<strong>Error! </strong> Wrong or invalid login credentials. Try again.");
            return back();
        }
    }

    public function showLoginForm(){
        return view('auth.admin-login');

    }


    public function  guard()
    {
        return Auth::guard('admin');
    }

}
