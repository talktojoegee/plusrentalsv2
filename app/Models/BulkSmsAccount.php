<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BulkSmsAccount extends Model
{

    use HasFactory;



    public function creditAccount($ref, $amount, $cost){
        $actual_amount = $amount/100;
        $units = $cost/3;
        $trans = new BulkSmsAccount();
        $trans->ref_no = $ref;
        $trans->company_id = Auth::user()->company_id;
        $trans->credit = $actual_amount;
        $trans->no_units = $units;
        $trans->unit_credit = $units;
        $trans->narration = "Purchase of ".$units." units @ ".$actual_amount;
        $trans->save();
    }

    public function debitAccount($ref, $amount, $units){
        //$actual_amount = $amount;
        //$units = $cost/3;
        $trans = new BulkSmsAccount();
        $trans->ref_no = $ref;
        $trans->company_id = Auth::user()->company_id;
        $trans->debit = $amount;
        $trans->no_units = $units;
        $trans->unit_debit = $units;
        $trans->narration = "Sending text message (".$units.") units @ ".$amount;
        $trans->save();
    }

    public function getBulkSmsTransactions(){
        return BulkSmsAccount::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }
}
