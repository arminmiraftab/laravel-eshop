<?php

namespace App\Http\Controllers;

use App\colormodel;
use App\Repository\CartRepository\CartRepositoryInterface;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use App\Repository\ColorRtepository\ColorRtepositoryInterface;
use App\Repository\ManufactureRtepository\ManufactureRtepositoryInterface;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Menu;
use App\products;
use App\manufactures;
use App\categorys;



class carte extends Controller
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
     * @var CartRepositoryInterface
     */
    protected $Cart;

    public function __construct(
        productsRtepositoryInterface $products,
        CategoryRtepositoryInterface $Category,
        ManufactureRtepositoryInterface $Manufacture,
        CartRepositoryInterface $Cart,
        ColorRtepositoryInterface $Color,
        MenuRtepositoryInterface $Menu
    ){
        $this->products = $products;
        $this->Category = $Category;
        $this->Manufacture = $Manufacture;
        $this->Color = $Color;
        $this->Menu = $Menu;
        $this->Cart = $Cart;
    }

    public function cart_show_add(Request $request){
        $Product_id=$request->Product_id;
        $product=$this->products->Product_add_cart($Product_id);
        $this->Cart->Add_Cart($request->Product_id,$request->qty,$product['name'],$product['price'],$product['photo']);
        return redirect::to('cart/card');
    }

    public function list_cart_show (){
        $menu = $this->Menu->show();
        $conents=$this->Cart->content();
            return view('page.add__card',compact('conents','menu'));
    }
    public function delete_product_cart_to_list($rowId){
        $Cart =$this->Cart->Delete($rowId);
        if ($Cart)
        return redirect::to('cart/card');

    }
    public function plus_product_cart_to_list(Request $request){

            if ($this->Cart->Update($request->cart_id ,$request->qrt,'plus')){
            $qrt=$request->qrt;
            ++$qrt;
            $total=$this->Cart->Total_Byid($request->cart_id );
            return response()->json(['qrt' => $qrt,'total' => $total]);
        }else{
            die(trans('error.failed'));
        }

    }
    public function fetch_cart(){
            $total=$this->Cart->Total();
        $tax=$this->Cart->tax();
        $subtotal=$this->Cart->subtotal();
        return response()->json(['total' => $total,'subtotal' => $subtotal,'tax' => $tax,]);
    }
    public function mines_product_cart_to_list(Request $request){
        if ($this->Cart->Update($request->cart_id ,$request->qrt,'mines')){
            $qrt=$request->qrt;
            --$qrt;
            $total=$this->Cart->Total_Byid($request->cart_id );
            return response()->json(['qrt' => $qrt,'total' => $total]);
        }else{
            die(trans('error.failed'));
        }
    }


}
