<?php


namespace App\Repository\SliderRepository;


use App\Helper\Helper;
use App\Http\Controllers\Product;
use App\image;
use App\Menu;
use App\Model\manufactures;
use App\products;
//use App\Model\products;
use App\sliders;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Repository\baseEloquent;


/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */
class EloquentSliderRepository implements SliderRepositoryInterface
{
    use baseEloquent;

    /**
     * @var SliderRepositoryInterface
     */

    protected $status = 'slider_status';
    /**
     * @var sliders
     */
    private $model;

    public function __construct(sliders $model)
    {
        $this->model = $model;
    }

    public function show()
    {
        $sliders = $this->model::with('photo')->active()->get();
        return Helper::Result_exist($sliders);
    }

    public function all()
    {
        $sliders = $this->model::with('photo')->orderBy('slider_id', 'desc')->get();
        return Helper::Result_exist($sliders);
    }

    public function store($request)
    {
        $data = new sliders;
        $data->sub_category_slider = $request->subcat;
        $data->category_slider = $request->cat;
        $data->detal_slider = $request->write;
        $data->submit_slider = $request->submit;
        $data->submit_link = $request->submit_link;
        $data->slider_status = $request->status;
        $data->save();

        if ($request->hasfile('images_slide')) {
            $image = new image;
            $image->images_id = $data->id;
            $image->imageable_alt = $request->alt;
            $image->imageable_path = $request->file('images_slide')->getClientOriginalName();
            $filename = time() . '.' . $image->imageable_path;
            $uplod_path = 'image/slider/';
            $image_url = $uplod_path . $filename;
            $path = $request->file('images_slide')->move($uplod_path, $filename);
            $image->images_type = sliders::class;
            $image->imageable_path = $image_url;
            $image->save();
        }
        return response()->json([
            'success' => 'باموفقیت انجام شد',
        ]);
    }

    public function update_Column($id, $Column, $chenge)
    {
        $value = $this->model::where('slider_id', $id)->update([$Column => $chenge]);
        return Helper::Result_bool($value);

    }

//
    public function find($id)
    {
        $find = $this->model::with(['photo'])->OfId($id)->first();
        return Helper::Result_exist($find);
    }

    public function update_bottom($id)
    {
        $product_find = $this->find($id);
        return $this->update_toggle($product_find, $this->status) ?
            $this->update_Column($id, $this->status, 0) :
            $this->update_Column($id, $this->status, 1);

    }

    public function delete($id): bool
    {
        $delete = $this->model::where('slider_id', $id)->delete();
        return Helper::Result_bool($delete);

    }

    public function update($id, $request)
    {
        $data = array();
//    $data = new sliders;
        $data['sub_category_slider'] = $request->subcat;
        $data['category_slider'] = $request->cat;
        $data['detal_slider'] = $request->write;
        $data['submit_slider'] = $request->submit;
        $data['submit_link'] = $request->submit_link;
        $data['slider_status'] = $request->status;
        $this->model::where('slider_id', $id)->update($data);

        image::where('images_id', $id)->where('images_type', sliders::class)->delete();
        $image = new image();
        $image->images_id = $id;
        $image->imageable_path = $request->file('images')->getClientOriginalName();
        $filename = time() . '.' . $image->imageable_path;
        $uplod_path = 'image/slider/';
        $image_url = $uplod_path . $filename;
        $path = $request->file('images')->move($uplod_path, $filename);
        $image->images_type = sliders::class;
        $image->imageable_path = $image_url;

        $image->save();

    }


}