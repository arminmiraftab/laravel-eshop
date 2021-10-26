<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\IdRequest;
use App\Http\Resources\SliderResource;
use App\image;
use App\products;
use App\Repository\SliderRepository\SliderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\sliders;
use Illuminate\Support\Facades\Validator;


class slider extends Controller
{
    protected $Slider;

    public function __construct(SliderRepositoryInterface $Slider){

        $this->Slider = $Slider;
    }
    public function index(){
        return view('admin.all_slider');
    }
    public function access(){
        return view('admin.add_slider');
    }
    protected function validator($data){
        $messages = [
            'subcat.required' => trans('Validation.slider.subcat.required'),
            'subcat.max' =>trans('Validation.slider.subcat.max'),
            'subcat.string' =>trans('Validation.slider.subcat.string'),
            'cat.max' => trans('Validation.slider.cat.max'),
            'cat.string' => trans('Validation.slider.cat.string'),
            'write.max' => trans('Validation.slider.write.max'),
            'write.string' => trans('Validation.slider.write.string'),
            'submit_link.max' => trans('Validation.slider.submit_link.max'),
            'submit_link.string' => trans('Validation.slider.submit_link.string'),
            'image_Product.required' => trans('Validation.slider.image_Product.required'),
            'image_Product.image' => trans('Validation.slider.image_Product.image'),
            'image_Product.mimes' => trans('Validation.slider.image_Product.mimes'),
            'alt.mimes.required' => trans('Validation.slider.alt.required'),
            'alt.mimes.string' => trans('Validation.slider.alt.string'),
            'alt.mimes.max' => trans('Validation.slider.alt.max'),

        ];
        return Validator::make($data, [
            'alt' => 'required|string|max:90',
            'images_slide' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'subcat' => 'required|string|max:60',
            'cat' => 'string|max:90',
            'write' => 'string|max:90',
            'submit' => 'string|max:50',
            'submit_link' => 'string|max:255',
        ],$messages);
    }
    public function save(Request $request){
        $validation=$this->validator($request->all());
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()]);
        } else {
            $all=$this->Slider->store($request);
            return $all;
        }
    }
    public function Act_Product(IdRequest $Request){
        if ($Request->id) {
            $updated= $this->Slider->update_bottom($Request->id);
             return Helper::Result($updated);
        } else {
            return response()->json(trans('Validation.error'));
        }
    }
    public function del_Product(IdRequest $Request){
        $delete=$this->Slider->delete($Request->id);

             return  Helper::Result($delete);
    }
    public function fetch_Product(){
       return SliderResource::collection($this->Slider->all()) ;
    }
    public function edit($id_slider){
        $value=$this->Slider->find($id_slider);
        return view('admin.Edit_slider'
            ,compact('value'));
    }
    public function edit_save(Request $request){
        $validation = Validator::make($request->all(), [
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        if($validation->passes()) {
            $this->Slider->update($request->id,$request);
            return response()->json([
                'message'   => $validation->errors()->all(),
            ]);
        }
    }

}
