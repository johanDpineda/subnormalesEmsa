<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LeagueMiddleware
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
//        if (Auth::check()) {
//            $loggedUser = Auth::user();
//            $loggedUserRoles = $loggedUser->getRoleNames();
//            view()->share('loggedUser', $loggedUser);
//            view()->share('loggedUserRoles', $loggedUserRoles);
//        }
        $loggedUser = Auth::user();

        if ($loggedUser) {
            $loggedUserRole = $loggedUser->getRoleNames()->first();
            view()->share('loggedUser', $loggedUser);
            view()->share('loggedUserRole', $loggedUserRole);
        }
        return $next($request);
    }
}
