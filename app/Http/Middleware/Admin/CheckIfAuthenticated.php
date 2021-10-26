<?php

namespace App\Http\Middleware\Admin;

use Closure;

class CheckIfAuthenticated
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
        if (!auth('admin')->check()) {
            return redirect()->route('log'); # admin login form
        }
        return $next($request);
    }
}
