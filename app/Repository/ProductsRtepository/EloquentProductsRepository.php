<?php



namespace App\Repository\ProductsRtepository;



use App\Helper\Helper;
use App\Http\Controllers\Product;
use App\image;
use App\Model\manufactures;
use App\products;
//use App\Model\products;
use Illuminate\Support\Facades\Validator;
use App\Repository\baseEloquent;


/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentProductsRepository implements ProductsRtepositoryInterface
{
    use baseEloquent;
        protected  $status='Product_status';
        protected  $recommended='recommended';
        public function __construct(products $model){
            $this->model = $model;
        }
        public function show(){
              $product=$this->model::active()->get();
            return Helper::Result_exist($product);
        }
        public function store($request){
            if ($request->optionsRadios){
                $flight = image::find($request->optionsRadios);
                $flight->first_photo=1;
                $flight->save();


            $data = new products;
            $data->manufacture_id = $request->manufacture_id;
            $data->category_id = $request->category_id;
            $data->Product_name = $request->name_Product;
            $data->Product_short_description = $request->short_description_Product;
            $data->Product_long_description = $request->long_description_Product;
            $data->Product_price = $request->price_Product;
            $data->Product_size = $request->size_Product;
            $data->color_id = $request->color_id;
            $data->Product_status = $request->status;
            $data->recommended =$request->recame;
            $data->save();
            foreach(explode(',',$request->image_Product) as $g){
                $flight = image::find($g);
                $flight->images_id=$data->Product_id;
                $flight->save();
            }

            return response()->json([
                'success' => 'با موفقیت انجام شد' ]);
            } else{
                return response()->json([
                    'error' => 'با موفقیت انجام نشد' ]);
            }
        }

        public function find($id){
            $find=$this->model::findOrFail($id);
            return Helper::Result_exist($find);
        }

        public function update_Column($id,$Column,$chenge){
            $value=$this->model::where('Product_id',$id)->update([$Column => $chenge]);
            if($value)
                return Helper::Result_bool($value);
        }
        function update_bottom ($id){
            $product_find =$this->find($id);
            return $this->update_toggle($product_find,$this->status) ?
                $this->update_Column($id,$this->status,0) :
                $this->update_Column($id,$this->status,1);
        }
        function update_bottom_recommended ($id){
            $product_find =$this->find($id);
            $this->update_toggle($product_find,$this->recommended) ?
                $this->update_Column($id,$this->recommended,0) : $this->update_Column($id,$this->recommended,1);
            return true;
        }
        public function find_product($id){
            $find= $this->model::with(['photo','brand','category'])
                     ->OfId($id)->first();
            return Helper::Result_exist($find);

        }
    public function find_detail($id){
        $find= $this->model::with(['photo','brand','category'])
            ->OfId($id)->get();
        return Helper::Result_exist($find);

    }
    public function find_detail_color($id){
        $find= $this->model::with(['photo','color'])
            ->where('product.color_id',$id)
            ->limit(9)->get();
        return Helper::Result_exist($find);

    }
    public function find_detail_Category($id){
            $show_Pro_filter=
                $this->model::with(['photo','category','brand'])
                ->where('category_id',$id)
                ->limit(9)->get();
        return $show_Pro_filter
            ->reject(function ($fg) {
                return $fg->category->category_status == null  ;
            })
            ->map(function ($order) {
                return $order;
            });
    }
     public function find_detail_manufacture($id){
         $show_Pro_filter= $this->model::with(['photo','category','brand'])
                  ->limit(9)
              ->where('manufacture_id',$id)
                         ->get();
         return $show_Pro_filter->reject(function ($fg) {
             return $fg->brand->manufacture_status == null  ;
         })
             ->map(function ($order) {
//              $order->Product_id != null;
                 return $order;
             });
        }

        public function update($request,$id){
//
        $data = products::find($id);
        $data->manufacture_id = $request->manufacture_id;
        $data->category_id = $request->category_id;
        $data->Product_name = $request->name_Product;
        $data->Product_short_description = $request->short_description_Product;
        $data->Product_long_description = $request->long_description_Product;
        $data->Product_price = $request->price_Product;
        $data->Product_size = $request->size_Product;
        $data->color_id = $request->color_id;
        $data->Product_status = $request->status;
        $data->recommended =$request->recame;
        $data->save();
//        return true;
//        $image = new image;
//        $image->images_id=$data->Product_id;
//        $image->imageable_path=$request->file('image_Product')->getClientOriginalName();
//        $filename  = time() . '.' . $image->imageable_path;
//
//        $uplod_path='image/';
//        $image_url=$uplod_path.$filename;
//        $request->file('image_Product')->move($uplod_path,$filename);
//        $image->images_type=products::class;
//        $image->imageable_path=$image_url;
//        $image->update();
//
//        return response()->json([
//            'success' => 'باموفقیت انجام شد',
//        ]);
    }
        public function delete($id):bool
    {
        $delete=$this->model::where('Product_id',$id)->delete();
        return Helper::Result_bool($delete);
    }
        public function all(){
            $Product=$this->model::with(['photo','brand','category'])
            ->orderBy('Product_id', 'asc')->get();
            return Helper::Result_exist($Product);
        }
        public function Product_photo(){
        $Product= $this->model::with(['photo'])->active()->limit(9)
            ->orderBy('Product_id', 'desc')->get();
            return Helper::Result_exist($Product);

    }
    public function Factor($id){
        $Factor= $this->model::with(['photo','category','brand'])
//            ->get();
//        $Factor=$this->model::with(['photo','brand','category'])
//            ->OfId($id)
//        $Factor= products::join('category','product.category_id','category.category_id')
//            ->join('manufacture','product.manufacture_id','=','manufacture.manufacture_id')
            ->join('order_details','product.product_id','order_details.product_id')->where('order_details.order_id',$id)
//            ->select('product.*')
            ->get();
        return Helper::Result_exist($Factor);

    }
        public function Product_find_photo($id){
        $photo= $this->model::with(['photo'])->OfId($id)
            ->orderBy('Product_id', 'desc')->first();
            return Helper::Result_exist($photo);

         }

         public function count():int
        {
            $count= $this->model::count();
            return Helper::Result_exist($count);

        }
        public function recommended()
        {
            $recommended= $this->model::with('photo')
                    ->Activerecommend()->Active()->get();
            return Helper::Result_exist($recommended);

        }
        public function find_all_order($id)
        {
            $orders= $this->model::with(['photo','category','order_details' => function($query)use ($id)
        {$query->where('order_id',$id);}])->get();
         return $orders->reject(function ($flight) {
            return $flight->order_details=='[]';
        });
        }
        public function Product_add_cart($id)
        {
            $Product=$this->Product_find_photo($id);
            foreach ($Product->photo as $image) {
                if($image->first_photo==1)
                    $photo = $image->imageable_path;
            }
            return[
                'name'=>$Product->Product_name,
                'price'=>$Product->Product_price,
                'photo' =>$photo

            ];

        }




}