<?php

namespace App\Http\Controllers;

use App\address;
use App\colormodel;
use App\Model\User;
use App\Notifications\InvoicePaidNotification;
use App\products;
use App\Repository\CartRepository\CartRepositoryInterface;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use App\Repository\ColorRtepository\ColorRtepositoryInterface;
use App\Repository\CommentRepository\CommentRepositoryInterface;
use App\Repository\ManufactureRtepository\ManufactureRtepositoryInterface;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\Repository\OrderRtepository\Order_DetailRepositoryInterface;
use App\Repository\OrderRtepository\OrderRepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use App\Repository\ShippingRepository\ShippingRepositoryInterface;
use App\Repository\SliderRepository\SliderRepositoryInterface;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Menu;
use App\categorys;
use App\manufactures;
use App\customermol;
use App\orders;
use App\shippings;
use App\payments;
use App\order_details;
use Illuminate\Support\Facades\URL;

class customer extends Controller
{
    /**
     * @var ProductsRtepositoryInterface
     */
    protected $products;
    /**
     * @var CategoryRtepositoryInterface
     */
    protected $Category;
    /**
     * @var ManufactureRtepositoryInterface
     */
    protected $Manufacture;
    /**
     * @var ColorRtepositoryInterface
     */
    protected $Color;
    /**
     * @var MenuRtepositoryInterface
     */
    protected $Menu;
    /**
     * @var SliderRepositoryInterface
     */
    protected $Slider;
    /**
     * @var CommentRepositoryInterface
     */
    protected $Comment;
    /**
     * @var ShippingRepositoryInterface
     */
    private $Shipping;
    /**
     * @var OrderRepositoryInterface
     */
    private $Order;
    /**
     * @var Order_DetailRepositoryInterface
     */
    private $Order_Detail;
    /**
     * @var CartRepositoryInterface
     */
    private $Cart;

    public function __construct(
        productsRtepositoryInterface $products,
        CategoryRtepositoryInterface $Category,
        ManufactureRtepositoryInterface $Manufacture,
        ColorRtepositoryInterface $Color,
        MenuRtepositoryInterface $Menu,
        SliderRepositoryInterface $Slider,
        CommentRepositoryInterface $Comment,
        ShippingRepositoryInterface $Shipping,
        OrderRepositoryInterface $Order,
        CartRepositoryInterface $Cart,
        Order_DetailRepositoryInterface $Order_Detail){


        $this->products = $products;
        $this->Category = $Category;
        $this->Manufacture = $Manufacture;
        $this->Color = $Color;
        $this->Menu = $Menu;
        $this->Slider = $Slider;
        $this->Comment = $Comment;
        $this->Shipping = $Shipping;
        $this->Order = $Order;
        $this->Order_Detail = $Order_Detail;
        $this->Cart = $Cart;
    }

    public function login_customer_dirc(){
       $menu = $this->Menu->show();
        abort_if(!$menu,404);

       return view('page.login_user_eshope',compact('menu'));
    }
    public function check(){
            $menu = $this->Menu->show();
        abort_if(!$menu,404);

        return view('page.check_out_customer',compact('menu'));
        }
    public function customer_payment_shop(){
            $conents=$this->Cart->content();
            $menu = $this->Menu->show();
            $adres=$this->Shipping->find_all();
        abort_if(! $menu|| ! $conents || ! $adres ,404);
        return view('page.pymet_custumer_shop_mon'
                ,compact('conents','menu','adres'));
        }
    public function delete_product_pay_to_list($rowId){
        if ($this->Cart->Delete($rowId)==true){
        return redirect::to('payment/payment');}else{
            return redirect::to('/');
        }
    }
    public function plus_product_pay_to_list($rowId,$qrt){
        if ($this->Cart->Update($rowId ,$qrt,'plus')){
            return redirect::to('/payment/payment');
        }else{
            die(trans('error.failed'));
        }
    }
    public function mines_product_pay_to_list($rowId,$qrt){
        if ($rowId&&$qrt) {
            if ($this->Cart->Update($rowId, $qrt, 'mines')) {
                return redirect::to('/payment/payment');
            }else{
                die(trans('error.failed'));
            }
        }else{
            return redirect::to('/');
        }
    }

}
