<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 29.08.2021
 * Time: 18:16
 */

namespace App\product_filter;


use Closure;
use Illuminate\Support\Str;

abstract class  Filter
{
    public function handle($request, Closure $next)
    {
        if (!\request()->has($this->Filter_Name()))
            return $next($request);

        $builder=$next($request);
        return $this->applyFilter($builder);

    }
     protected abstract function applyFilter($builder);

    protected function  Filter_Name(){
        return Str::snake(class_basename($this));

    }
}