<?php

namespace App\Http\Controllers;

use App\colormodel;
use App\Http\Resources\RecommendRequest;
use App\model\View;
use App\product_filter\brand_filter\brand;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use App\Repository\ColorRtepository\ColorRtepositoryInterface;
use App\Repository\CommentRepository\CommentRepositoryInterface;
use App\Repository\ManufactureRtepository\ManufactureRtepositoryInterface;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use App\Repository\SliderRepository\SliderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Menu;
use Illuminate\Support\Facades\URL;
use App\manufactures;
use App\products;
use App\categorys;
use App\sliders;
use App\commentsmol;
use App\icons;
use Jenssegers\Agent\Facades\Agent;

class main extends Controller
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

    public function __construct(
        productsRtepositoryInterface $products,
        CategoryRtepositoryInterface $Category,
        ManufactureRtepositoryInterface $Manufacture,
        ColorRtepositoryInterface $Color,
        MenuRtepositoryInterface $Menu,
        SliderRepositoryInterface $Slider,
        CommentRepositoryInterface $Comment){

        $this->products = $products;
        $this->Category = $Category;
        $this->Manufacture = $Manufacture;
        $this->Color = $Color;
        $this->Menu = $Menu;
        $this->Slider = $Slider;
        $this->Comment = $Comment;
    }
   public function index(){
        $show_rec=RecommendRequest::collection($this->products->recommended());
        $i=0; $a=0;
       $show_Product=$this->products->Product_photo();
       $menu = $this->Menu->show();
       $sliders=$this->Slider->all();
       $this->view();
       abort_if(! $menu|| ! $show_Product || ! $sliders|| ! $show_rec ,404);
       return view('page.home',compact(
           'a','show_Product' ,'i','sliders','show_rec','menu'));
    }
    public function product_show_all_category($category_id){
        $this->view();
        $all_table_manufacture=$this->Manufacture->show();
        $all_table_category=$this->Category->show();
        $all_table_color=$this->Color->show();
        $j=app(Pipeline::class)
            ->send(products::query()->with(['photo','brand','category'])
             ->where('product.color_id',$category_id))
            ->through([brand::class])->thenReturn();
        $menu = $this->Menu->show();
        $show_rec=$this->products->recommended();
        return view('page.show_product_and_category',[
            'show_Pro_cat'=>$j->get(),
            'all_table_manufacture'=>$all_table_manufacture,
            'all_table_category'=>$all_table_category,
            'all_table_color'=>$all_table_color,
            'menu'=>$menu,
            'show_rec'=>$show_rec,

        ]);
    }
    public function product_show_details_all($Product_id){
        $this->view();

        $comment= $this->Comment->comment_product($Product_id);
        $show_Pro_pro=$this->products->find_detail($Product_id);
        $i=0;$menu = $this->Menu->show();
        $show_rec=$this->products->recommended();
        return view('page.show_product-details',
            compact('show_rec', 'show_Pro_pro' ,'i','menu','comment'));
    }
    public function serch_user_product(Request $request){
        if (request()->has('product')){
        $product = request('product');
        }else{
            $product = $request->input('product');
        }
//        $product = $request->input('product');
//        $show_Pro=$this->products->all();
//        foreach ($show_Pro as $user) {
//        return   products::with(['photo','brand','category'])->where('Product_name', 'LIKE', '%' . $product . '%')->get();
//        }

        $all_table_manufacture=$this->Manufacture->show();
        $all_table_category=$this->Category->show();
        $all_table_color=$this->Color->show();
        $j=app(Pipeline::class)
            ->send(products::query()->with(['photo','brand','category'])
//                ->where('Product_name', 'LIKE', '%' . $product . '%')
                ->where('product.Product_name','LIKE', '%' . $product . '%'))
                ->through([brand::class])->thenReturn();
        $menu = $this->Menu->show();
        $show_rec=$this->products->recommended();
        return view('page.show_product_search',[
            'show_Pro_cat'=>$j->distinct()->get(),
            'all_table_manufacture'=>$all_table_manufacture,
            'all_table_category'=>$all_table_category,
            'all_table_color'=>$all_table_color,
            'menu'=>$menu,
            'show_rec'=>$show_rec,

        ]);
//        return $serviceFound;
//        $show_Pro_pro=$this->products->find_detail($Product_id);
//        return view('page.show_product-details',
//            compact('show_rec', 'show_Pro_pro' ,'i','menu','comment'));
    }


    private function view(){
        $data = new view;
        $data->browser = Agent::browser();
        $data->device =Agent::device();
        $data->platform =Agent::platform();
        $data->Path =$_SERVER['REQUEST_URI'];
        $data->save();
    }



}
