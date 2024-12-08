<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     if (Auth::check() && Auth::user()->is_admin) {
    //         return $next($request);
    //     }

    //     return redirect('/'); // Redirect non-admin users to the homepage or another route
    // }
    public function handle($request, Closure $next)
{
    // Temporarily bypass all admin checks
    return $next($request);
}

}
