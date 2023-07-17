<?php

namespace App\Http\Middleware;

use Closure, Auth;

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
        if(Auth::user()->role == "0"):
            return $next($request);
        elseif(Auth::user()->role == "1"):
            return $next($request);
        elseif(Auth::user()->role == "2"):
            return $next($request);
        elseif(Auth::user()->role == "3"):
            return $next($request);
        elseif(Auth::user()->role == "4"):
            return $next($request);
        elseif(Auth::user()->role == "5"):
            return $next($request);
        elseif(Auth::user()->role == "6"):
            return $next($request);
        elseif(Auth::user()->role == "7"):
            return $next($request);
        else:
            return redirect('/logout');
        endif;
    }
}
