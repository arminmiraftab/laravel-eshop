<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\OrderRtepository;


interface Order_DetailRepositoryInterface{
    public function find_all($orderid);
    public function delete($id);
    public function count();
    public function order_details_id($id);
    public function order_details_last($id);
    public function order_details_user($id,$order_id);
    public function store($id,$id_order, $data,$shipping_id,$time);
    public function order_id($customer_id);
}