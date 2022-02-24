<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartOfAccount extends Model
{
    use HasFactory;





    /*
     * Use-case methods
     */

    public function insertDefaultAccounts(){
       $coa_fields = array(
            [
                'account_name'=>'Asset',
                'account_type'=>1,
                'bank'=>0,
                'glcode'=>1,
                'parent_account'=>0,
                'type'=>0,
                'company_id'=>Auth::user()->company_id,
            ],
            [
                'account_name'=>'Liability',
                'account_type'=>2,
                'bank'=>0,
                'glcode'=>2,
                'parent_account'=>0,
                'type'=>0,
                'company_id'=>Auth::user()->company_id,
            ],
            [
                'account_name'=>'Equity',
                'account_type'=>3,
                'bank'=>0,
                'glcode'=>3,
                'parent_account'=>0,
                'type'=>0,
                'company_id'=>Auth::user()->company_id,
            ],
            [
                'account_name'=>'Revenue',
                'account_type'=>4,
                'glcode'=>4,
                'bank'=>0,
                'parent_account'=>0,
                'type'=>0,
                'company_id'=>Auth::user()->company_id,
            ],
            [
                'account_name'=>'Expenses',
                'account_type'=>5,
                'bank'=>0,
                'glcode'=>5,
                'parent_account'=>0,
                'type'=>0,
                'company_id'=>Auth::user()->company_id,
            ]
        );
        ChartOfAccount::insert($coa_fields);
    }

    public function setNewChartOfAccount(Request $request){
        $account = new ChartOfAccount();
        $account->account_name = $request->account_name;
        $account->account_type = $request->account_type;
        $account->bank = $request->bank;
        $account->glcode = $request->glcode;
        $account->parent_account = $request->parent_account;
        $account->type = $request->type;
        $account->company_id = Auth::user()->company_id;
        $account->save();
    }

    public function getAllDetailChartOfAccounts(){
        return ChartOfAccount::where('type',1)->where('company_id', Auth::user()->company_id)->orderBy('glcode','ASC')->get();
    }

    public function getCompanyChartOfAccount(){
        return ChartOfAccount::where('company_id', Auth::user()->company_id)->orderBy('glcode','ASC')->get();
    }
}
