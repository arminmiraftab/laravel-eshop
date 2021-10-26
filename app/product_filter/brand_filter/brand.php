<?php
namespace App\product_filter\brand_filter;

use App\product_filter\Filter;
use Closure;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 21.08.2021
 * Time: 16:39
 */

class brand extends Filter
{
    protected  function applyFilter($builder){
      return  $builder->whereIn('manufacture_id',\request($this->Filter_Name()));
    }


}