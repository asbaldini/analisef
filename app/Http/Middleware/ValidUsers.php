<?php

namespace AnaliseF\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ValidUsers
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
        if(is_null(Auth::user()) || Auth::user()->status == 0)
            return redirect('/logout');

        return $next($request);
    }
}
