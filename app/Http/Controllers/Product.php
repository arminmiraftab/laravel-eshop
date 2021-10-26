<?php

namespace App\Http\Controllers;

use App\category_maunfactur;
use App\colormodel;
use App\commentsmol;
use App\Helper\Helper;
use App\Http\Requests\IdRequest;
use App\Http\Resources\productResource;
use App\image;
use App\Repository\CategoryRtepository\Category_Maunfactur_Repository\Category_Maunfactur_Repository_Interface;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use App\Repository\ColorRtepository\ColorRtepositoryInterface;
use App\Repository\ImageRepository\ImageRtepositoryInterface;
use App\Repository\ManufactureRtepository\ManufactureRtepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use App\sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\categorys;
use App\manufactures;
use App\products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class Product extends Controller
{

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
     * @var ProductsRtepositoryInterface
     */
    private $products;
    /**
     * @var ImageRtepositoryInterface
     */
    protected $Image;
    /**
     * @var Category_Maunfactur_Repository_Interface
     */
    protected $Category_Maunfactur;

    public function __construct(
        productsRtepositoryInterface $products,
        CategoryRtepositoryInterface $Category,
        ManufactureRtepositoryInterface $Manufacture,
        ImageRtepositoryInterface $Image,
        Category_Maunfactur_Repository_Interface $Category_Maunfactur,
        ColorRtepositoryInterface $Color){
        $this->Category = $Category;
        $this->Manufacture = $Manufacture;
        $this->Color = $Color;
        $this->products = $products;
        $this->Image = $Image;
        $this->Category_Maunfactur = $Category_Maunfactur;
    }
    public function add(){
        $all_table_category=$this->Category->show();
        $all_table_manufacture=$this->Manufacture->show();
        $all_table_color=$this->Color->show();
        return view('admin.add_Product',
         compact('all_table_category','all_table_manufacture','all_table_color'));
    }
    public function test(){
        $all=$this->products->all();
        abort_if(!$all,404);

        return $all;
    }
    protected function validator($data){
        $messages = [
            'name_Product.required' =>  trans('Validation.Product.name_Product.required'),
            'name_Product.max' =>trans('Validation.Product.name_Product.max'),
            'name_Product.string' => trans('Validation.Product.name_Product.string'),
            'short_description_Product.string' => trans('Validation.Product.short_description_Product.string'),
            'short_description_Product.max' => trans('Validation.Product.short_description_Product.max'),
            'short_description_Product.required' => trans('Validation.Product.short_description_Product.string'),
            'long_description_Product.string' =>  trans('Validation.Product.long_description_Product.string'),
            'long_description_Product.max' => trans('Validation.Product.long_description_Product.max'),
            'long_description_Product.required' => trans('Validation.Product.long_description_Product.required'),
            'category_id.required' => trans('Validation.Product.category_id.required'),
            'category_id.numeric' => trans('Validation.Product.category_id.numeric'),
            'color_id.required' => trans('Validation.Product.color_id.numeric'),
            'color_id.numeric' =>trans('Validation.Product.color_id.numeric'),
            'price_Product.required' => trans('Validation.Product.price_Product.required'),
            'price_Product.numeric' => trans('Validation.Product.price_Product.numeric'),
            'size_Product.string' => trans('Validation.Product.size_Product.string'),
            'size_Product.required' =>  trans('Validation.Product.size_Product.required'),
            'image_Product.required' => trans('Validation.Product.image_Product.required'),
            'image_Product.image' =>  trans('Validation.Product.image_Product.required'),
            'image_Product.mimes' =>  trans('Validation.Product.image_Product.required'),

        ];
        return Validator::make($data->all(), [
            'optionsRadios' => 'required',
            'category_id' => 'required|numeric',
            'color_id' => 'required|numeric',
            'name_Product' => 'required|string|max:90',
            'short_description_Product' => 'required|string|nullable|max:65534',
            'long_description_Product' => 'required|string|nullable|max:65534',
            'price_Product' => 'required|numeric',
            'size_Product' => 'required|string',
        ],$messages);
    }
    public function save_add(Request $request){
        $validation=$this->validator($request);
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()]);
        } else {
        $all=$this->products->store($request);
            return $all;
        }
    }
    public function image_delete_Product(IdRequest $request){
        $product = $this->Image->find($request->id);
        return Helper::Result($product);
    }
    public function all(){
        return view('admin.all_show_Product');
    }
    public function Act_Product(IdRequest $Request){
        if ($Request->id) {
            $updated=$this->products->update_bottom($Request->id);
          return Helper::Result($updated);
        }else {
            return response()->json(['error' => 'باموفقیت انجام نشد']);
        }
    }
    public function edit($Product_id){
        $all_table_color=$this->Color->show();
        $all_table_category=$this->Category->show();
        $all_table_manufacture=$this->Manufacture->show();
        $db_info= $this->products->find_product($Product_id);
            return view('admin.EDIT_Product',
                compact('all_table_color', 'db_info','all_table_category', 'all_table_manufacture'));
    }
    public function edit_image_product(Request $request){
       return $this->Image->update($request);
    }
    public function del_Product(IdRequest $Request){
        $val= $this->products->delete($Request->id);
        $output= Helper::Result($val);
        return $output;
    }
    public function serch_brand(Request $request)
    {   $name= $this->Category_Maunfactur ->serch_brand($request);
        return response()->json($name);
    }
    public function Fetch_Product(){
        return productResource::collection($this->products->all());
    }
    public function delete_image_edite_Product(Request $request){
        $name='l';
        return response()->json($request->id);
    }
    public function image_save_Product(Request $request){
        if($request->hasfile('image_Product')) {
            return $this->Image->store($request);
        }
    }
    public function Updatepro(Request $request,$id){
        $this->products->update($request,$id);
        return redirect::to('/admin/admin_Product/show_Product');

    }

}
