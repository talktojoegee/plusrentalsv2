<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserCompany(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getUserProperties(){
        return $this->hasMany(Property::class, 'company_id', 'company_id')->orderBy('id', 'DESC');
    }

    public function getCompanyLeaseApplications(){
        return $this->hasMany(TenantApplicant::class, 'company_id', 'company_id')->orderBy('id', 'DESC');
    }

    public function getCompanyInvoices(){
        return $this->hasMany(Invoice::class, 'company_id', 'company_id')->orderBy('id', 'DESC');
    }

    public function getCompanyBills(){
        return $this->hasMany(Bill::class, 'company_id', 'company_id')->orderBy('id', 'DESC');
    }

    public function getScheduleLeases(){
        return $this->hasMany(ScheduleLease::class, 'company_id', 'company_id')->orderBy('id', 'DESC');
    }

    public function getCompanyStorage(){
        return $this->hasMany(FileModel::class, 'company_id', 'company_id');
    }

    public function getAllCompanyMails(){
        return $this->hasMany(Email::class, 'company_id', 'company_id');
    }


    public function getCompanyPaymentIntegration(){
        return $this->belongsTo(CompanyPaymentIntegration::class, 'company_id', 'company_id');
    }

    public function getUserTheme(){
        return $this->belongsTo(Theme::class, 'active_theme');
    }


    /*
     * Use-case methods
     */

    public function getAllActiveUsers(){
        return User::where('account_status',1)->where('company_id', Auth::user()->company_id)->orderBy('first_name', 'ASC')->get();
    }
    public function getAllCompanyUsers(){
        return User::where('company_id', Auth::user()->company_id)->orderBy('first_name', 'ASC')->get();
    }

    public function getAllUsers(){
        return User::where('company_id', Auth::user()->company_id)->orderBy('first_name', 'ASC')->get();
    }

    public function setNewUser(Request $request, $company_id){
        //$password = substr(sha1(time()), 32,40);
        $user = new User();
        $user->first_name = $request->first_name ?? '';
        //$user->surname = $request->surname ?? '';
        $user->password = bcrypt($request->password);
        $user->email = $request->email ?? '';
        //$user->address = $request->address ?? '';
        //$user->mobile_no = $request->mobile_no ?? '';
        $user->url = substr(sha1(time()), 22,40);
        $user->company_id = $company_id;
        $user->save();
    }

    public function getUserById($id){
        return User::find($id);
    }
    public function getUserBySlug($slug){
        return User::where('url',$slug)->where('company_id', Auth::user()->company_id)->first();
    }

    public function getAllUsersByCompanyId($id){
        return User::where('company_id', $id)->where('account_status',1)->get();
    }
    public function getAllActiveUsersByCompanyId(){
        return User::where('company_id', Auth::user()->company_id)->where('account_status',1)->get();
    }


    public function updateUserAccountStatus($user_id, $status){
        $user = User::find($user_id);
        $user->account_status = $status;
        $user->save();
    }

    public function updateProfile(Request $request){
        $user = User::find($request->user);
        $user->first_name = $request->first_name;
        $user->surname = $request->surname;
        $user->position = $request->position;
        $user->address = $request->address;
        $user->mobile_no = $request->mobile_no;
        $user->save();
    }

    public function updateAvatar(Request $request){
        if($request->hasFile('avatar'))
        {
            $extension = $request->avatar->getClientOriginalExtension();
            $filename = Str::slug(Auth::user()->first_name).'_' . uniqid(). '.' . $extension;
            $dir = 'assets/drive/';
            $request->avatar->move(public_path($dir), $filename);
            $avatar = User::find(Auth::user()->id);
            $avatar->avatar = $filename;
            $avatar->save();
        }
    }

    public function checkForExpiredCompanies(){
       /* $companies = Company::all();
        foreach($companies as $company){
            if(strtotime(now()) > strtotime($company->end_date) ){
                $company->
            }
        }*/
    }
}
