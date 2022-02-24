<?php

namespace App\Models;

use App\Mail\GeneralEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Email extends Model
{
    use HasFactory;


    public function getEmailReceivers(){
        return $this->hasMany(EmailReceiver::class, 'email_id');
    }

    public function getReceiver(){
        //return $this->belongsTo(EmailReceiver::)
    }





    /*
     * Use-case methods
     */

    public function setNewEmail(Request $request){
        $email = new Email();
        //$email->email_type = $request->email_type;
        $email->scheduled = $request->scheduled ?? '';
        $email->schedule_date_time = $request->schedule_timestamp ?? '' ;
        $email->sent_by = Auth::user()->id;
        $email->company_id = Auth::user()->company_id;
        $email->subject = $request->subject;
        $email->email_body = $request->email_body;
        $email->tracking_id = substr(sha1(time()),20,40);
        $email->save();
        return $email;

    }

    public function getAllMailsNotSent(){ //this runs in the background
        return Email::where('status', 0)->get();
    }

    public function sendMails(){
        $mails = $this->getAllMailsNotSent();
        foreach($mails as $mail){
            #Send mail
            foreach ($mail->getEmailReceivers as $receiver){
                try{
                    \Mail::to($receiver->getTenant)->send(new GeneralEmail($mail, $receiver->getTenant, $receiver->getCompany));
                    $mail->status = 1;
                    $mail->save();
                }catch (\Exception $exception){
                    $mail->status = 2;//couldn't send
                    $mail->save();
                }
            }

        }
    }

}
