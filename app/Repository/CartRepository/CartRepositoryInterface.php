<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 08.09.2021
 * Time: 19:01
 */

namespace App\Repository\CartRepository;


interface CartRepositoryInterface
{
    public function Add_Cart($id,$quantity,$name,$price,$photo);
    public function content();
    public function isEmpty();
    public function Delete($id);
    public function Update($id,$quantity,$opration);
    public function Total_Byid($id);
    public function Total();
    public function tax();
    public function subtotal();


    }