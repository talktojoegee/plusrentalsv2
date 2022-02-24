<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use App\Models\Task;
use App\Models\TaskConversation;
use App\Models\Tenant;
use App\Models\TenantNotification;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth:manager');
        $this->task = new Task();
        $this->taskconversation = new TaskConversation();
        $this->user = new User();
        $this->property = new Property();
        $this->tenant = new Tenant();
        $this->maintenance = new MaintenanceRequest();
        $this->tenantnotification = new TenantNotification();
    }

    public function showNewTaskForm(){
        $users = $this->user->getAllActiveUsersByCompanyId();
        $properties = $this->property->getAllCompanyProperties();
        return view('manager.tasks.add-new-task', ['users'=>$users, 'properties'=>$properties]);
    }

    public function manageMaintenanceRequests(){
        $maintenance_requests = $this->maintenance->getAllCompanyMaintenanceRequests();
        if(!empty($maintenance_requests)){
            return view('manager.tasks.maintenance-requests',['requests'=>$maintenance_requests]);
        }
    }

    public function manageTasks(){
        $tasks = $this->task->getAllCompanyTasks();
        return view('manager.tasks.manage-tasks', ['tasks'=>$tasks]);
    }

    public function viewTask($slug){
        $task = $this->task->getTask($slug);
        if(!empty($task)){
            return view('manager.tasks.view-task',['task'=>$task]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }

    public function storeTask(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'property'=>'required'
        ]);

        $task = $this->task->setTask($request);
        #Notification
        $title = 'New Task';
        $body = "Your maintenance request was successfully registered. We'll attend to it ASAP.";
        $route = 'maintenance-detail';
        $this->tenantnotification->setNewNotification($title, $body, $route, $task->tenant_id, $task->slug);

        session()->flash("success", "<strong>Success!</strong> We've registered your new task.");
        return back();
    }


    public function leaveComment(Request $request){
        $this->validate($request,[
            'task'=>'required',
            'comment'=>'required'
        ]);
        $this->taskconversation->setConversation($request);
        return view('manager.tasks.partials._conversations',['task'=>$this->task->getTaskById($request->task)]);
    }



}
