<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Impersonate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 
     * 
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('impersonate_user_id'))
        {
            Auth::onceUsingId($request->session()->get('impersonate_user_id'));
        }
        return $next($request);
    }
}
