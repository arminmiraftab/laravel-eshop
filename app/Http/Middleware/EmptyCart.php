<?php

namespace App\Http\Middleware;

use App\Repository\CartRepository\CartRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Redirect;

class EmptyCart
{
    /**
     * @var CartRepositoryInterface
     */
    private $Cart;

    public function __construct(CartRepositoryInterface$Cart)
    {
        $this->Cart = $Cart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  if($this->Cart->isEmpty()){
        return redirect::to('/');}

        return $next($request);
    }
}
