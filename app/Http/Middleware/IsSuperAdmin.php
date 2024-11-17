<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check())
        {
            if(auth()->user()->role_id == 1)
            {
                return $next($request);
            }
            else{
                return redirect('/dashboard');
            }
        }
        else
        {
            return redirect('/login');
        }
    }
}
