<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultChartOfAccount extends Model
{
    use HasFactory;



    public function setNewChartOfAccount($company_id){
        $accounts = DefaultChartOfAccount::all();
        foreach($accounts as $acc){
            $account = new ChartOfAccount();
            $account->account_name = $acc->account_name;
            $account->account_type = $acc->account_type;
            $account->bank = $acc->bank;
            $account->glcode = $acc->glcode;
            $account->parent_account = $acc->parent_account;
            $account->type = $acc->type;
            $account->company_id = $company_id;
            $account->save();
        }

    }
}
