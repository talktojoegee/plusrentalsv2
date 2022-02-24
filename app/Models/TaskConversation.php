<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskConversation extends Model
{
    use HasFactory;


    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
     * Use-case methods
     */

    public function getTaskConversationByTaskId($id){
        return TaskConversation::where('task_id', $id)->where('company_id', Auth::user()->company_id)->get();
    }

    public function setConversation(Request $request){
        $conversation = new TaskConversation();
        $conversation->user_id = Auth::user()->id;
        $conversation->task_id = $request->task;
        $conversation->conversation = $request->comment;
        $conversation->company_id = Auth::user()->company_id;
        $conversation->save();
    }
}
