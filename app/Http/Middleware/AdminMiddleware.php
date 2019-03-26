<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && auth()->user()->type == 0) {
            return $next($request);
        }
        if (Auth::guard($guard)->check() && auth()->user()->type == 1) {
            return redirect('/home');
        }

        return redirect('/');
    }
}
