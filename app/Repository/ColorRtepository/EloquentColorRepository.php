<?php



namespace App\Repository\ColorRtepository;


use App\Helper\Helper;
use App\Model\colormodel;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentColorRepository implements ColorRtepositoryInterface
{
     public function show(){
        $color= colormodel::all();
         return Helper::Result_exist($color);
        }
}