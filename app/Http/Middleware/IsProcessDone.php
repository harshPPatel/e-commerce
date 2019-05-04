<?php

namespace App\Http\Middleware;

use Closure;

class isProcessDone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $status stauts of adding product status 
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        if ($request->process_status == '1') {
            return $next($request);
        } else {
            return \redirect('/user/admin/products')->with('error', 'Bad Request Sent. Complete other steps before!');
        }
    }
}
