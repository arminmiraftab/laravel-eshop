<?php



namespace App\Repository\PayRtepository;


use App\Model\colormodel;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentPayRepository implements PayRtepositoryInterface
{


     public function show(){
        $color= colormodel::all();
        return $color;
        }
}