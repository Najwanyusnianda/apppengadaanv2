<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIsNotSM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard="subject_matter")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('sm.login'));
        }
        return $next($request);
    }
}
