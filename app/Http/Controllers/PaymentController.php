<?php
namespace App\Http\Controllers;
use App\Model\payments;
use App\Model\products;
use App\order_details;
use App\orders;
use App\Repository\CartRepository\CartRepositoryInterface;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\Repository\OrderRtepository\Order_DetailRepositoryInterface;
use App\Repository\OrderRtepository\OrderRepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Shetabit\Multipay\Exceptions;
use Exception;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use SoapFault;

class PaymentController extends Controller
{
    /**
     * @var CartRepositoryInterface
     */
    protected $Cart;
    /**
     * @var OrderRepositoryInterface
     */
    protected $Order;
    /**
     * @var MenuRtepositoryInterface
     */
    protected $Menu;
    /**
     * @var Order_DetailRepositoryInterface
     */
    protected $Order_Detail;
    /**
     * @var ProductsRtepositoryInterface
     */
    protected $Product;

    public function __construct(CartRepositoryInterface $Cart
                                ,OrderRepositoryInterface $Order
                                ,Order_DetailRepositoryInterface $Order_Detail
                                ,ProductsRtepositoryInterface $Product
                                ,MenuRtepositoryInterface $Menu )
    {

        $this->Cart = $Cart;
        $this->Order = $Order;
        $this->Menu = $Menu;
        $this->Order_Detail = $Order_Detail;
        $this->Product = $Product;
    }

    public function order_place(Request $request){
        if ($request->shipping_id=='null'){
            return Redirect::to('payment/payment')
                ->with('customer_adres', trans('Validation.address.empty'));
        }else{
            $customer_id = Auth::id();
            $Total=$this->Cart->Total();
            $total= (int) str_replace("," , "" , $Total);
            $date=Carbon::now()->timestamp;
            $date=$date+3600;
            $orderpayment_id=$this->Order->store($customer_id,$total,$request->shipping_id,$date);
            $conents=Cart::content();
            $this->Order_Detail->store($customer_id,$orderpayment_id,$conents,$request->shipping_id,$date);
            Cart::destroy();
            return Redirect::to('payment/factor');
        }
    }
    public function okpay(Request $request){
        $customer_id=Auth::id();
        $Order_price= $this->Order->latest_Order_price($customer_id);
//        return $Order_price;
//        $qyt=$request->total;
        $payment_gateway=$request->payment_gateway;
        $customer_id = Auth::id();
        $status_order= $this->Order->lasr_order_user($customer_id);
        return redirect::to('payment/pay/');
//        return redirect('/payment/pay/'.$Order_price)->with('status', $Order_price);
//        $ds=orders::where('order_id',$status_order)->update(['order_status'=>' پرداخت شد']);
//        $ds=orders::where('order_id',$status_order)->update(['state_fa'=>1]);

//        $payment_gateway=$request->payment_gateway;
//        $pdata['payment_method']=$payment_gateway;
//        if($payment_gateway=='handcach'){
//            echo 'مبلغ پرداخت شد:'.$qyt.'سپه';
//        }elseif($payment_gateway=='two'){
//            echo 'مبلغ پرداخت شد:'.$qyt.'ملی';
//        }elseif($payment_gateway=='tree'){
//            echo 'مبلغ پرداخت شد:'.$qyt.'تجارت';
//        }else{
//            echo "not sele ct";
//        }
    }
//    public function payok(){
//        $pdata=new payments;
//        $pdata['payment_method']=$payment_gateway;
//        $pdata['Product_id']=$status_order;
//        $pdata['user_id']=$customer_id;
//        $payment_id=$pdata->save();
//    }
    public function factor_order(){
        $menu = $this->Menu->show();
        $customer_id=Auth::id();
        $time=$this->Order->time($customer_id);
        $sd=$this->Order_Detail->order_id($customer_id);
        $dt=Carbon::now()->timestamp;
        $total=$this->Order->latest_Order_user($sd);
        $factor=$this->Product->Factor($sd);
        return view('page.factor',
            compact('menu','factor','total','dt','time'));    }
    public function distime(){

        $customer_id = Auth::id();
//        $re=order_details::where('customer_id', $customer_id)->select('order_details_id')->latest()->first();
        $re=$this->Order_Detail->order_details_id($customer_id);
        $sd=$re->order_details_id;
        $ds=order_details::where('order_details_id',$sd)->update(['state_fa'=>0]);
//        return Redirect::to('/factor');
        $status=$this->Order->lasr_order_user($customer_id);
//            orders::where('customer_id', $customer_id)->select('order_id')->latest()->first();
        $status_order=$status->order_id;
        $ds=orders::where('order_id',$status_order)->update(['order_status'=>' لغوشد']);

        $customer_id = Auth::id();
        $re=$this->Order_Detail->order_details_last($customer_id);
//            order_details::where('customer_id', $customer_id)->latest()->first();
        $sd=$re->order_id;
        $s=$re->time_fa;
//        $ds=order_details::where('order_id',$sd)->get();
        $dt=Carbon::now()->timestamp;

        $total=order_details::where('order_id',$sd)->sum('Product_price');
        $all_table_color=$this->Color->show();

        $all_table_manufacture=$this->Manufacture->show();
        $all_table_category=$this->Category->show();
        $menu = $this->Menu->show();
        $factor=$this->products->find_all_order($sd);
        return view('page.factor',compact('menu','factor','total','s','dt'));
    }
}
