<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SubscriptionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\StripeController;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $data['plans'] = Plan::where('status', 1)->get();
        return view('dashboard.plan.index',$data);
    }
    public function checkout($id)
    {
        if(auth()->user()->role_id != 2){
            return redirect()->route('home')->with('error','Access Denied');
        }
        $data['plan'] = Plan::find($id);
        return view('dashboard.plan.checkout',$data);
    }

    public function checkout_process(Request $request,$id)
    {
        $data = $request->all();
        session()->put('data',$data);
        if($request->payment_method == 'stripe')
        {
            $stripe = new StripeController();
            $url = $stripe->payment($data);
            return redirect()->away($url);
        }
    }
    public function purchase($data)
    {
        if($data['duration'] == 'monthly')
        {
            $duration = date('Y-m-d', strtotime('+1 month'));
        }else
        {
            $duration = date('Y-m-d', strtotime('+1 year'));
        }
        $plan = Plan::find($data['plan_id']);
        $plan_data = [
            'name' => $plan->name,
            'monthly_price' => $plan->monthly_price,
            'yearly_price' => $plan->yearly_price,
            'max_users' => $plan->max_users,
            'max_projects' => $plan->max_projects,
            'max_tasks' => $plan->max_tasks,
            'duration' => $data['duration']
        ];
        $plan_json = json_encode($plan_data);
        Subscription::where('organization_id', auth()->user()->organization->id)
        ->update(['status' => 0]);
        Subscription::create([  
            'start_date' => date('Y-m-d'),
            'end_date' => $duration,
            'organization_id' => auth()->user()->organization->id,
            'plan_id' => $plan->id,
            'plan_data' => $plan_json,
            'payment_method' => $data['payment_method'],
            'status' => 1
        ]);
        session()->forget('data');
        return true;
    }

    public function my_plans(SubscriptionsDataTable $dataTable){
        return $dataTable->render('dashboard.plan.my_plans');
    }

    public function change_subscription(Request $request)
    {
        if(auth()->user()->role_id != 2){
            return response()->json(['status' => 'error','message' => 'Access Denied']);
        }
        Subscription::where('organization_id',auth()->user()->organization->id)->update(['status' => 0]);
        $subscription = Subscription::find($request->plan_id);
        $subscription->status = 1;
        $subscription->save();
        return response()->json(['status' => 'success']);
    }
}
