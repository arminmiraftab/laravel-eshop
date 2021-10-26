<?php

namespace App\Http\Middleware;

use App\Model\orders;
use Closure;
use Carbon\Carbon;
use App\order_details;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class istimefa
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
        $customer_id=Auth::id();
        $details=orders::where('customer_id', $customer_id)->orderBy('order_id','desc')->first();

        $time_fa=$details->time_fa;
        $time_now=Carbon::now()->timestamp;
        if ($time_now<$time_fa){

            return $next($request);

        }else{
            return Redirect::to('payment/disfator');



        }
    }
}
