<?php

namespace App\Http\Middleware;

use Closure;

class LocaleMiddleware
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
        if ($request->locale !== 'fa' && $request->locale !== 'en') {
            app()->setLocale('fa');
        } else {
            app()->setLocale($request->locale);
        }
    
        return $next($request);
    }
}
