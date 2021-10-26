<?php



namespace App\Repository\ImageRepository;


use App\image;
use App\Model\categorys;
use App\products;
use App\Repository\baseEloquent;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentImageRepository implements ImageRtepositoryInterface
{
    use baseEloquent;

    /**
     * @var categorys
     */
    protected $model;
    protected  $status='category_status';


    public function __construct(image $model)
    {
        $this->model = $model;
    }

    public function find($id){
        $product=image::find($id);
        $product->delete();

        return $product;
    }
    public function store($request){
        $data=array();
        foreach($request->file('image_Product') as $file)
        {    $image = new image;
            $image->images_id=588;
            $image->imageable_alt=123;
            $filename = Str::random(20).'.'.$file->extension();
            $uplod_path='image/';
            $image_url=$uplod_path.$filename;
            $file->move(public_path().'/image/', $filename);
            $image_url=$uplod_path.$filename;
            $image->images_type=products::class;
            $image->imageable_path=$image_url;
            $image->save();
            $id[]=$image->id;
            $data= Arr::add($data, $image->id, $image_url);
        }return response()->json([
            'image'=>$data,
            'ids'=>$id]);
    }

    public function  update($request){
        $data=array();
        foreach($request->file('image_Product') as $file)
        {    $image = new image;
            $image->images_id=$request->Product_id;
            $image->imageable_alt=123;

            $filename = Str::random(20).'.'.$file->extension();
            $uplod_path='image/';
            $image_url=$uplod_path.$filename;
            $file->move(public_path().'/image/', $filename);
            $image_url=$uplod_path.$filename;
            $image->images_type=products::class;
            $image->imageable_path=$image_url;
            $image->save();
            $id[]=$image->id;
            $data= Arr::add($data, $image->id, $image_url);
        }
        return response()->json([
            'image'=>$data,
            'ids'=>$request->Product_id]);
        }


}