<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Company;
use App\Models\DefaultChartOfAccount;
use App\Models\Subscription;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->user = new User();
        $this->company = new Company();
        $this->subscription = new Subscription();
        $this->defaultcoa = new DefaultChartOfAccount();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return redirect()->route('start-free-trial');
    }

    public function startFreeTrial(){
        return view('auth.register');
    }

    public function processStartFreeTrial(Request $request){
        $this->validate($request, [
            'email'=>'required|email|unique:users,email',
            'first_name'=>'required',
            'password'=>'required|confirmed',
            'terms'=>'required'
        ],[
           'email.required'=>'Enter your email address',
           'email.email'=>'Enter a valid email address',
           'email.unique'=>'There is an existing account with the email address you entered.',
           'first_name.required'=>'Enter your first name',
           'password.required'=>'Choose a strong password',
           'password.confirmed'=>'Password mis-match. Chosen password is not same with re-type password.',
            'terms.required'=>'Accept our terms & conditions to register.'
        ]);
        $company = $this->company->setNewCompany();
        $this->user->setNewUser($request, $company->id);
        $this->defaultcoa->setNewChartOfAccount($company->id);
        $this->subscription->setNewSubscription($company->id, $company->plan_id, $company->active_subscription_key, $company->start_date, $company->end_date);
        try{
            \Mail::to($request)->send(new WelcomeMail($request));
        }catch (\Exception $exception){

       }
        session()->flash("success", "<strong>Congratulations!</strong> Your account was created successfully. We also generated Chart of Accounts for you.");
        return redirect()->route('manager-login');
    }
}
