<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\PlanController;
use App\Models\Plan;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function payment($request)
    {
        $plan = Plan::find($request['plan_id']);
        if($plan->duration == 'monthly'){
            $price = $plan->monthly_price;
        }else{
            $price = $plan->yearly_price;
        }
        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $session = \Stripe\Checkout\Session::create([
           'line_items' => [
            [
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => $plan->name,
                    ],
                    'unit_amount' => 100 * $price, 
                ],
                 'quantity' => 1,
            ],
        ],
        
        'mode' => 'payment',
        'success_url' => route('stripe.checkout.success'),
        'cancel_url' => route('stripe.checkout.cancel'),
        
    ]);
        return $session->url;
    }

    public function success()
    {   
        $data = session('data');
        $purchase = new PlanController();
        $response = $purchase->purchase($data);
        if($response){
            return redirect('/')->with('success','Plan Purchased Successfully');
        }
        
    }
    public function cancel()
    {   
        dd("cancel");
    }
}
