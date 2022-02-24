<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalVoucher extends Model
{
    use HasFactory;


    /*
     * Use-case methods
     */

    public function setNewJournalVoucher(Request $request){
        $ref_no = substr(sha1(time()), 32,40);
        for($n = 0; $n<count($request->account); $n++){
            $jv = new JournalVoucher();
            $jv->glcode = $request->account[$n];
            $jv->narration = $request->narration[$n];
            $jv->name = $request->name[$n];
            $jv->dr_amount = $request->debit_amount[$n];
            $jv->cr_amount = $request->credit_amount[$n];
            $jv->ref_no = $ref_no;
            $jv->jv_date = $request->issue_date;
            $jv->entry_date = now();
            $jv->posted = 0;
            $jv->trash = 0;
            $jv->company_id = Auth::user()->company_id;
            $jv->entry_by = Auth::user()->id;
            $jv->slug = substr(sha1(time()),30,40);
            $jv->save();
        }
    }
}
