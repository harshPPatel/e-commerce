<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class IsAdmin
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
        // Checking if user is logged in or not.
        if(Auth::check()) {
            // Getting userRole from isAdmin column value
            $userRole = Auth::user()->isAdmin;
            // If user is admin, it will redirect him to admin dashboard.
            if ($userRole == 1) {
                return redirect('/home');
//                return redirect('/user/admin/categories');
            }
        }
        return $next($request);
    }
}
