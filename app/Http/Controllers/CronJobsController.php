<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CronJobsController extends Controller
{
    public function analyse_subscriptions()
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription) {
            if($subscription->status == 1){
                $start_date = Carbon::parse($subscription->start_date);
                $using_days = $start_date->diffInDays();
                $subscription->using_days = $using_days;
                $subscription->save();
            }else{
                $end_date = Carbon::parse($subscription->end_date)->addDay();
                $subscription->end_date = $end_date;
                $subscription->save();
            }
        }
    }
}
