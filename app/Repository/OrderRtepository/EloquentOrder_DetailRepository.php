<?php



namespace App\Repository\OrderRtepository;


use App\Helper\Helper;
use App\Model\categorys;
use App\order_details;
use App\orders;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentOrder_DetailRepository implements Order_DetailRepositoryInterface
{
    /**
     * @var orders
     */
    protected $model;

    public function __construct(order_details $model){
        $this->model = $model;
    }
    public function find_all($order_id){
     $find= $this->model::with(['user','address','order_details'])
       ->where('order_id',$order_id)->get();
        return Helper::Result_exist($find);

    }
    public function find_order($order_id){
        $find= $this->model::with(['order_details'])
            ->where('order_id',$order_id)->get();
        return Helper::Result_exist($find);

    }

    public function delete($id){
        $delete= $this->model::where('order_id',$id)->delete();
        return Helper::Result_exist($delete);

    }
    public function count():int
    {
        $count= $this->model::count();
        return Helper::Result_exist($count);

    }
    public function order_details_id($customer_id):int{
        $order= $this->model::where('customer_id', $customer_id)->select('order_details_id')->latest()->first();
        return Helper::Result_exist($order);

    }
    public function order_details_last($customer_id):string{
        $order= $this->model::where('customer_id', $customer_id)->latest()->first();
        return Helper::Result_exist($order);

    }
    public function order_id($customer_id):string{
        $order= $this->model::where('customer_id', $customer_id)->orderBy('order_details_id','desc')->latest()->first()->order_id;
        return Helper::Result_exist($order);

    }
    public function order_details_user($customer_id,$order_id)
    {
        $order= $this->model::with(['order_photo'])
            ->join('shipping','shipping.shipping_id','order_details.shipping_id')
            -> join('Product','order_details.Product_id','Product.Product_id')
            ->where('order_details.customer_id', $customer_id)->where('order_details.order_id', $order_id)->get();
        return Helper::Result_exist($order);

    }
    public function store($customer_id,$orderpayment_id,$total,$shipping_id,$date):int
    {
        $oddate=array();

        foreach($total as $cont ) {
            $oddate['order_id'] = $orderpayment_id;
            $oddate['Product_id'] = $cont->id;
            $oddate['Product_name'] = $cont->name;
            $oddate['Product_price'] = $cont->price;
            $oddate['Product_sales_quantity'] = $cont->qty;
            $oddate['time_fa'] =$date;
            $oddate['state_fa'] =0;
            $oddate['customer_id'] =$customer_id;
            $oddate['shipping_id']= $shipping_id;
            $d=$this->model::insert($oddate);
        }
        return true;

    }



}