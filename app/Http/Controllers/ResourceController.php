<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailReceiver;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    //
    public function __construct()
    {
        $this->email = new Email();
        $this->emailreceiver = new EmailReceiver();
    }


    public function sendMails(){
        $this->email->sendMails();

    }
}
