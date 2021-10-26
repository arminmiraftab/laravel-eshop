<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\OrderRtepository;


interface OrderRepositoryInterface{
    public function show();
    public function find_all($orderid);
    public function delete($id);
    public function count();
    public function store($id,$data,$shipping_id,$time);
    public function lasr_order_user($id);
    public function  update_Column_pay($id,$chenge);
    public function  find_Order_User($id);
    public function  analyze_sales_Day();
    public function  analyze_sales_Month();
    public function  time($customer_id);
    public function  latest_Order_user($id);
    public function  latest_Order_price($id);


}