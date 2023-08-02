<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // checks whether the authenticator's usertype is 1 or not
        // if 1 returns the request else access is denied is displayed
        if(Auth::check()){
            if(Auth::user()->usertype == '1'){
                return $next($request);
            }
            else{
                redirect('/login')->with('status','Access denied');
            }
        }
        else{
            redirect('/login')->with('status','please login !');
        }
    }
}
