<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BulkMessage extends Model
{
    use HasFactory;

    public function setNewMessage($msg, $phone_numbers){
        $message = new BulkMessage();
        $message->company_id = Auth::user()->company_id;
        $message->sent_by = Auth::user()->id;
        $message->status = 1;
        $message->slug = substr(sha1(time()),29,40);
        $message->message = $msg;
        $message->sent_to = $phone_numbers;
        $message->save();
    }

    public function getTenantMessages(){
        return BulkMessage::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();
    }

    public function getTenantMessageBySlug($slug){
        return BulkMessage::where('company_id', Auth::user()->company_id)->where('slug', $slug)->first();
    }
}
