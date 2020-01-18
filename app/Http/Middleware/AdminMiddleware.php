<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::chech() && Auth::user()->role()->id==1)
        {
            return $next($request);
        }else{
            return redirect()->back()->withInput($request->only('email','remember'));
        }
    }
}
