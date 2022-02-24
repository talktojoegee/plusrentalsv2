<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DefaultGLAccount extends Model
{
    use HasFactory;


    public function getChartOfAccount(){
        //return $this->belongsTo(ChartOfAccount::class, '');
    }

    public function getAccountByTransaction($transaction){
        return DefaultGLAccount::where('company_id', Auth::user()->company_id)->where('transaction', $transaction)->first();
    }

    public function getAllDefaultAccounts(){
        return DefaultGLAccount::where('company_id', Auth::user()->company_id)->get();
    }
}
