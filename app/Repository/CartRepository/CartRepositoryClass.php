<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 08.09.2021
 * Time: 17:25
 */

namespace App\Repository\CartRepository;


use App\Helper\Helper;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartRepositoryClass implements CartRepositoryInterface
{
    public function Add_Cart($Product_id,$qrt,$name,$price,$photo){
        $date['qty']=$qrt;
        $date['weight']=0;
        $date['id']= $Product_id;
        $date['name']= $name;
        $date['price']= $price;
        $date['options']['image'] = $photo;
        Cart::add($date);

    }
    public function content(){
        $content= Cart::content();
        return Helper::Result_exist($content);

    }
    public function isEmpty():bool {
           $isEmpty=$this->content()->isEmpty();
        return Helper::Result_bool($isEmpty);
    }
        public function Delete($rowId):bool {
          $Delete= Cart::remove($rowId);
            return Helper::Result_bool($Delete);
    }
    public function Update($rowId,$quantity,$opration):bool {
        if ($opration=='plus'){
            $Update=Cart::update($rowId,['qty' =>++$quantity]);
            return Helper::Result_bool($Update);
        }
        if ($opration=='mines'){
            $Update= Cart::update($rowId,['qty' =>--$quantity]);
            return Helper::Result_bool($Update);
        }
    }
     public function Total_Byid($rowId){

       $Total= Cart::content()->get($rowId)->total;
         return Helper::Result_exist($Total);
      }
     public function Total(){
         $Total= Cart::total();
         return Helper::Result_exist($Total);
      }
      public function subtotal(){
          $subtotal= Cart::subtotal();
          return Helper::Result_exist($subtotal);

      }
     public function tax(){
         $tax= Cart::tax();
         return Helper::Result_exist($tax);

     }

}