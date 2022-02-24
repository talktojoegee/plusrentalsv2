<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;


    /*
     * Use-case
     */

    public function setNewSubscription($company_id, $plan_id, $sub_key, $start_date, $end_date){
        $sub =  new Subscription();
        $sub->start_date = $start_date;
        $sub->end_date = $end_date;
        $sub->sub_key = $sub_key;
        $sub->company_id = $company_id;
        $sub->plan_id = $plan_id;
        $sub->save();
    }

    public function getSubscriptionByKey($key){
        return Subscription::where('active_subscription_key', $key)->first();
    }

    public function updateSubscriptionStatusByKey($sub_key, $status){
        $sub = Subscription::where('sub_key',$sub_key)->first();
        $sub->status = $status;
        $sub->save();
    }
}
