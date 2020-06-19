<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if(Auth::guest()) {
            return redirect('/admin/login');
        } else {
            if(Auth::User()->role == 'user') {
                return redirect("/");
            }
        }
        return $next($request); 
    }
}
