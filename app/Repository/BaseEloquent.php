<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 18.08.2021
 * Time: 14:34
 */

namespace App\Repository;


use App\Model\products;
use Illuminate\Support\Facades\View;

trait baseEloquent
{
    public function __construct($model)
    {

    }
    public function update_toggle($product_find,$Column):bool
    {
        $status=$product_find->$Column==1 ? 1 :  0;
        return $status;
    }

}