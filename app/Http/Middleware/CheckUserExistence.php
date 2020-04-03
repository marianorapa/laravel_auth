<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

use App\User;

class CheckUserExistence
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
        if (User::get()->first()){
            if (Auth::user())
            {
                return redirect(route('main'));
            }
            else 
            {
                return redirect(route('login')); // 03-04 01:21 Agrego redirect, si no pincha
            }
        }

        return $next($request);
    }
}
