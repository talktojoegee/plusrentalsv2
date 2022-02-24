<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\EmailReceiver;
use App\Models\EmailTemplate;
use App\Models\Tenant;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->emailtemplate = new EmailTemplate();
        $this->tenant = new Tenant();
        $this->email = new Email();
        $this->emailreceiver = new EmailReceiver();
    }


    public function manageEmailTemplates(){

        return view('manager.communication.manage-email-templates', [
            'templates'=>$this->emailtemplate->getAllEmailTemplates()
        ]);
    }

    public function showEmailTemplateForm(){
        return view('manager.communication.new-email-template');
    }

   public function composeEmail(Request $request){
       if($request->scheduled == 1){
           $this->validate($request,[
               'subject'=>'required',
               'email_body'=>'required',
               'schedule_timestamp'=>'required',
           ],[
               'subject.required'=>'Enter a subject for this email',
               'email_body.required'=>'Enter content for this email',
               'schedule_timestamp.required'=>'Select delivery date & time',
           ]);
       }else{
           $this->validate($request,[
               'subject'=>'required',
               'email_body'=>'required',
           ],[
               'subject.required'=>'Enter a subject for this email',
               'email_body.required'=>'Enter content for this email',
           ]);
       }
       $email = $this->email->setNewEmail($request);
       //$this->email->sendMails();
       foreach($request->tenants as $tenant){
           $this->emailreceiver->setNewEmailReceivers($request, $email, $tenant);
       }
       session()->flash("success", "<strong>Success!</strong> Your mail was sent");
       return back();
    }


    public function emailSettings(){
        return view('manager.communication.email-settings');
    }

    public function storeEmailTemplate(Request $request){
        $this->validate($request, [
           'template_name'=>'required',
           'subject'=>'required',
           'body'=>'required'
        ]);
        $this->emailtemplate->setNewEmailTemplate($request);
        session()->flash("success", "<strong>Great!</strong> New email template saved.");
        return redirect()->route('manage-email-templates');
    }
    public function editEmailTemplate(Request $request){
        $this->validate($request, [
           'template_name'=>'required',
           'subject'=>'required',
           'body'=>'required'
        ]);
        $this->emailtemplate->editNewEmailTemplate($request);
        session()->flash("success", "<strong>Great!</strong> Email template changes saved.");
        return redirect()->route('manage-email-templates');
    }

    public function showEditEmailTemplateForm($slug){
        $template = $this->emailtemplate->getEmailTemplateBySlug($slug);
        if(!empty($template)){
            return view('manager.communication.edit-email-template',['template'=>$template]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Template not found.");
            return back();
        }
    }


    public function showComposeEmailForm(){

        return view('manager.communication.compose-email', ['tenants'=>$this->tenant->getTenants()]);
    }


    public function manageEmailCommunication(){
        return view('manager.communication.manage-email');
    }

    public function storeNewEmail(Request $request){



    }
}
