<?php

namespace App\Http\Controllers\Auth;

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


    public function login(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required'
        ],
            [
                'email.required'=>'Enter your registered email',
                'password.required'=>'Enter valid password for this account.'
            ]);
        //$tenant = Tenant::where('email', $request->email)->first();
        if(Auth::guard('tenant')->attempt([
            'email'=>$request->email,
            'password'=>$request->password, 'account_status'=>1],
            $request->remember)){
            session()->flash("update_profile", "<strong>Notice: </strong> You're adviced to complete your profile");
            return redirect()->route('profile');
        }else{
            session()->flash("error", "<strong>Error! </strong> Wrong or invalid login credentials. Try again.");
            return back();
        }
    }

   /* public function loginTenant(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required'
        ],
        [
            'email.required'=>'Enter your registered email',
            'password.required'=>'Enter valid password for this account.'
        ]);

        //$tenant = Tenant::where('email', $request->email)->first();
        if(Auth::guard('tenant')->attempt([
            'email'=>$request->email,
            'password'=>$request->password, 'account_status'=>1],
            $request->remember)){
            session()->flash("update_profile", "<strong>Notice: </strong> You're adviced to complete your profile");
            return redirect()->route('profile');
        }else{
            session()->flash("error", "<strong>Error! </strong> Wrong or invalid login credentials. Try again.");
            return back();
        }
    }*/

}
