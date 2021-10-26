<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class iscustomer
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


        if (!Auth::check())
            return Redirect::to('panel_user/login_clint');

        return $next($request);

}
//    public function fd($request, Closure $next)
//    {
//        $customer_id=Session::get('customer_id');
//        if(!$customer_id)
//        {
//            return Redirect::to('/login_clint')->send();
//        }
//    }


}
