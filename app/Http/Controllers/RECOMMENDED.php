<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\IdRequest;
use App\products;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RECOMMENDED extends Controller
{
    /**
     * @var productsRtepositoryInterface
     */
    protected $products;

    public function __construct(
        productsRtepositoryInterface $products){
        $this->products = $products;
    }
    public function RECOMMENDED_show(){
        $all_slider_table=$this->products->Product_photo();
        return view('admin.all_RECOMMENDED_show',compact('all_slider_table'));
    }

    public function Act_Product_recommended(IdRequest $Request){
        $value=  $this->products->update_bottom_recommended ($Request->id);
        return Helper::Result($value);

    }
    public function Act_recommended($Product_id){
        $value= $this->products->update_bottom_recommended($Product_id);
          if ($value){
        session::put('messagea','عملیات باموفقیت انجام شد');
        return redirect::to('/admin/admin_RECOMMENDED/RECOMMENDED');}
        else{
            session::put('messagea','عملیات باموفقیت انجام نشد');

            return redirect::to('/admin/admin_RECOMMENDED/RECOMMENDED');

    }
    }

}
