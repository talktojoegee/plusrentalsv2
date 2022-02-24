<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;



    public function getTaskAttachments(){
        return $this->hasMany(TaskAttachment::class, 'task_id');
    }

    public function getTaskAssignments(){
        return $this->hasMany(TaskAssignment::class, 'task_id');
    }

    public function getTaskConversations(){
        return $this->hasMany(TaskConversation::class, 'task_id');
    }

    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getProperty(){
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getTaskFrontendConversations(){
        return $this->hasMany(TaskFrontendConversation::class, 'task_id');
    }


    /*
     * Use-case methods
     */

    public function setTask(Request $request){
        $tenant = Tenant::where('property_id', $request->property)->first();
        $slug = substr(sha1(time()),34,40);
        //if(!empty($tenant)){
            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->property_id = $request->property;
            $task->tenant_id = !empty($tenant) ? $tenant->id :  '';
            $task->start_date = $request->start_date ?? '';
            $task->end_date = $request->end_date ?? '';
            $task->slug = $slug;
            $task->company_id = Auth::user()->company_id;
            $task->save();
            $taskId = $task->id;
            #Upload attachment
            if($request->hasFile('attachment')){
                foreach($request->file('attachment') as $file)
                {
                    $extension = $file->getClientOriginalExtension();
                    $dir = 'assets/drive/';
                    $name = '_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                    $file->move(public_path($dir.$name));
                    $attchment = new TaskAttachment();
                    $attchment->directory = $name;
                    $attchment->task_id = $taskId;
                    $attchment->company_id = Auth::user()->company_id;
                    $attchment->save();
                }
            }
            #Assign task to selected persons
            if($request->assign_to ){
                foreach($request->assign_to as $assign){
                    $assignment = new TaskAssignment();
                    $assignment->task_id = $taskId;
                    $assignment->assigned_to = $assign;
                    $assignment->assigned_by = Auth::user()->id;
                    $assignment->company_id = Auth::user()->company_id;
                    $assignment->save();
                }
            }
           return $task;

        //}

    }

    public function getAllTasks(){
        return Task::orderBy('id', 'DESC')->get();

    }
    public function getAllCompanyTasks(){
        return Task::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();

    }

    public function getTask($slug){
        return Task::where('slug', $slug)->first();
    }

    public function getTaskById($id){
        return Task::find($id);
    }

}
