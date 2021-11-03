<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next) {
        if (! \App\User::where('id', Auth::id())->first()->is_admin) {
            Auth::logout();

            return redirect()->route('dashboardLogin');
        }

        return $next($request);
    }
}
