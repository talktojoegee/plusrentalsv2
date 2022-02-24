<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskFrontendConversation extends Model
{
    use HasFactory;

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }




    /*
     * Use-case methods
     */

    public function setNewFrontendConversation(Request $request){
        $conversation = new TaskFrontendConversation();
        $conversation->user_id = Auth::guard('web') ? Auth::user()->id : '';
        $conversation->tenant_id = Auth::guard('tenant') ? Auth::user()->id : '';
        $conversation->task_id = $request->task;
        $conversation->message = $request->comment ?? '';
        $conversation->company_id = Auth::user()->company_id;
        $conversation->save();
    }


}
