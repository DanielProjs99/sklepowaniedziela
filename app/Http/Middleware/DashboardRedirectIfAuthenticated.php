<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class DashboardRedirectIfAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $loggedIn = Auth::check();

        if ($loggedIn && \App\User::where('id', Auth::id())->first()->is_admin) {
            return redirect()->route('dashboard');
        }
        else if ($loggedIn) {
            Auth::logout();
        }

        return $next($request);
    }
}
