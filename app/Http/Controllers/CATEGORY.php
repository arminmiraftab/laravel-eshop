<?php

namespace App\Http\Controllers;


use App\Helper\Helper;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryServisResource;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\categorys;
use Illuminate\Support\Facades\Validator;

class CATEGORY extends Controller
{

    protected $Category;
    public function __construct(CategoryRtepositoryInterface $Category)
    {
        $this->Category = $Category;

    }

    public function index(){
        return view('admin.ADDCATEGORY');
    }
    public function all(){
        $manege=$this->Category->all();
        abort_if(!$manege,404);
        return view('admin.allcategory',compact('manege'));
    }
    protected function validator($Request){
        $messages = [
            'name.required' => trans('Validation.category.name.required'),
            'name.max' => trans('Validation.category.name.max'),
            'name.string' => trans('Validation.category.name.string'),
            'description.max' => trans('Validation.category.description.max'),
        ];
        return Validator::make($Request, [
            'name' => 'required|string|max:90',
            'description' => 'string|nullable|max:65534',
        ],$messages);
    }
    public function cheCATEGORY(Request $Request){
        $validation=$this->validator($Request->all());
        $output= $validation->fails() ?
            response()->json(['error' => $validation->errors()]) :
            $this->Category->store($Request);
        abort_if(!$output,404);
        return $output;
    }
    public function edit($category_id){
        $db_info= $this->Category->find_Category($category_id);
        $manege=view('admin.EDIT_CATEGORY')->with('db_info',$db_info);
        abort_if(!$manege,404);

        return view('admin_panel')->with('admin.EDIT_CATEGORY',$manege);
    }
    public function update($category_id,CategoryRequest $request){
        $this->Category->update_Category($category_id,$request);
        return redirect::to('/admin/admin_category/show-CATEGORY');
    }
    public function fetch_category(){
        $date=$this->Category->all();
        abort_if(!$date,404);
        return CategoryServisResource::collection($date);
            }
    public function delete_CATEGORY_save(Request $Request){
        $val=$this->Category->delete($Request->id);
        abort_if(!$val,404);
        return Helper::Result($val);
    }
    public function Active_CATEGORY_save(Request $Request){
        if ($Request->id) {
            $updated=$this->Category->update_bottom($Request->id);
            abort_if(!$updated,404);
            return Helper::Result($updated);
    } else {return response()->json(['error' => 'باموفقیت انجام نشد']);}
    }

}
