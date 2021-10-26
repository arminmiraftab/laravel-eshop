<?php



namespace App\Repository\OrderRtepository;


use App\Helper\Helper;
use App\Model\categorys;
use App\orders;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentOrderRepository implements OrderRepositoryInterface
{

//    public function all(){
//
//    }
//    public function find(){
//
//    }
    /**
     * @var orders
     */
    protected $model;

    public function __construct(orders $model)
    {
        $this->model = $model;
    }
     public function show(){
         $order=  $this->model::with(['user'])
             ->orderBy('order.order_id', 'desc')
             ->get();
         return Helper::Result_exist($order);

     }
    public function find_all($order_id){
      $find=$this->model::with(['user','address','order_details'])
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
        return Helper::Result_bool($delete);

    }
    public function count():int
    {
        $count= $this->model::count();
        return Helper::Result_exist($count);

    }
    public function store($customer_id,$total,$shipping_id,$date):int
    {
        $odata=new  orders;
        $odata['customer_id']=$customer_id;
        $odata['shipping_id']= $shipping_id;
        $odata['order_total']=$total;
        $odata['order_status']='درحال انتظار';
        $odata['time_fa'] =$date;
        $odata['state_fa'] =0;
        $odata->save();
        return Helper::Result_exist($odata->id);


    }
    public function lasr_order_user($id){
        $status=orders::where('customer_id',$id )->select('order_id')->latest()->first();
        return Helper::Result_exist($status->order_id);

    }
    public function update_Column_pay($id,$chenge){
//           $product_find =$this->find($id);
        $value=$this->model::where('order_id',$id)->update(['order_status'=>$chenge]);
        if($value)
            return Helper::Result_bool($value);

    }
    public function find_Order_User($id){
          $find= $this->model::where('customer_id',$id)
            ->select('order.*')
            ->paginate(3);
        return Helper::Result_exist($find);

    }
    public function analyze_sales_Day(){
          $analyze= DB::table('order')
            ->where('payment_id','!=',null)
            ->select(DB::raw('DAY(created_at) as time'),DB::raw('sum(order_total) as total'))
            ->groupBy(DB::raw('DAY(created_at) DESC '))
            ->get();
        return Helper::Result_exist($analyze);

    }
    public function analyze_sales_Month(){
        $analyze= DB::table('order')
            ->where('payment_id','!=',null)
            ->select(DB::raw('Month(created_at) as time'),DB::raw('sum(order_total) as total'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->get();
        return Helper::Result_exist($analyze);

    }
    public function time($customer_id){
        $time = $this->model::where('customer_id', $customer_id)->orderBy('order_id','desc')->latest()->first()->time_fa;
        return Helper::Result_exist($time);

    }
    public function latest_Order_user($order_id){
               $Order= $this->model::where('order_id',$order_id)->latest()->first();
        return Helper::Result_exist($Order);

    }
   public function latest_Order_price($id){
       $Order=  $this->model::where('order_id',$id)->latest()->first()->order_total;
       return Helper::Result_exist($Order);

   }
}