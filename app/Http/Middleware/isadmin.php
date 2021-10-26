<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class isadmin
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
        $admin_id=Session::get('true_away');
        if($admin_id)
        {        return $next($request); //<-- this line :)
        }
        else{
//            return redirect()->route('admin_login');
            return Redirect::to('/')->send();
        }

    }
}
