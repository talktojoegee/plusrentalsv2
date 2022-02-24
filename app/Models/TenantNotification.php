<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantNotification extends Model
{
    use HasFactory;



    /*
     * Use-case methods
     */

    public function markAllAsRead(){
        $notifications = TenantNotification::where('tenant_id', Auth::user()->id)->get();
        if(count($notifications) > 0){
            foreach($notifications as $notify){
                $notify->is_read = 1;
                $notify->is_read = now();
                $notify->save();
            }
        }
    }

    public function setNewNotification($subject, $body, $route, $tenant, $slug){
        $notification = new TenantNotification();
        $notification->subject = $subject;
        $notification->body = $body;
        $notification->route_name = $route;
        $notification->tenant_id = $tenant;
        $notification->sent_by = Auth::user()->id;
        $notification->slug = $slug;
        $notification->save();


    }

   /* public function getAllUnreadNotifications(){

    }*/


}
