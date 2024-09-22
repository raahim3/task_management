<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;


class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subscription = auth()->user()->organization->subscriptions()->where('status', 1)->first();
        if($subscription)
        {
            $today = Carbon::now();
            $endDate = Carbon::parse($subscription->end_date);
            if ($endDate->isToday()) {
                return $next($request);
            } elseif ($endDate->isBefore($today)) {
                return redirect()->route('plan.index')->with('error', 'Your subscription has expired.');
            } else {
                return $next($request);
            }
        }
        else
        {
            return redirect()->route('plan.index');
        }
    }
}
