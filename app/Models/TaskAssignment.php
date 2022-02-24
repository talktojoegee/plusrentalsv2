<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskAssignment extends Model
{
    use HasFactory;

    public function getAssignedTo(){
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignTask(Request $request){
        foreach($request->persons as $person){
            $assignment = new TaskAssignment();
            $assignment->task_id = $request->task;
            $assignment->assigned_by = Auth::user()->id;
            $assignment->assigned_to = $person;
            $assignment->company_id = Auth::user()->company_id;
            $assignment->save();
        }
    }


    public function acceptTask(Request $request){
        $task = TaskAssignment::find($request->task);
        $task->status = 3; //task accepted & started
        $task->start_date = now();
        $task->save();
    }

    public function markTaskAsCompleted(Request $request){
        $task = TaskAssignment::find($request->task);
        $task->status = 4; //task completed
        $task->end_date = now();
        $task->save();
    }
}
