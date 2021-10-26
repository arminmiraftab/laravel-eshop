<?php



namespace App\Repository\CategoryRtepository;


use App\Helper\Helper;
use App\Model\categorys;
use App\Repository\baseEloquent;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentCategoryRepository implements CategoryRtepositoryInterface
{
    use baseEloquent;

    /**
     * @var categorys
     */
    protected $model;
    protected  $status='category_status';


    public function __construct(categorys $model)
    {
        $this->model = $model;
    }

    public function show(){
        $category=$this->model::active()->distinct()->get();
        return Helper::Result_exist($category);
    }
    public function all(){
        $category=$this->model::all();
        return Helper::Result_exist($category);
    }
    public function store($Request){
        $data=array();
        $data['category_name']=$Request->name;
        $data['category_description']= $Request->description;
        ($Request->category_status ==NULL) ? $data['category_status'] = 0 : $data['category_status'] = $Request->category_status;
        $vlaue=categorys::insert($data);
        return response()->json([
            'success' => 'باموفقیت انجام شد',]);
    }
    public function find_Category($category_id){
        $category= categorys::where('category_id',$category_id)->first();
        return Helper::Result_exist($category);
    }
    public function updates($id,$request):bool {
        $data=array();

        $data['category_name']=$request->name_category;
        $data['category_description']=$request->description_category;

        $category=categorys::where('category_id',$id)->update($data);
        return Helper::Result_bool($category);
//return $request;
    }
    public function delete($id):bool {
        $category= categorys::where('category_id',$id)->delete();
        return Helper::Result_bool($category);

    }

    public function update_Column($id,$Column,$chenge){
        $this->model::where('category_id',$id)->update([$Column => $chenge]);
    }
//
    function update_bottom ($id):bool{
        $product_find =$this->find_Category($id);
        $this->update_toggle($product_find,$this->status) ?
            $this->update_Column($id,$this->status,0) :
            $this->update_Column($id,$this->status,1);
        return true;
    }

    function brand (){
        $category=$this->model::with('brands')->active()->get();
        return Helper::Result_exist($category);

    }
    function category_brand ($exp){
        $category= $this->model::whereNotIn('category_id',$exp )->select('category_name','category_id')->get();
        return Helper::Result_exist($category);

    }
     function update_Category ($id,$request){
         $data=array();
         $data['category_name']=$request->name_category;;
         $data['category_description']=$request->description_category;
         $category= categorys::where('category_id',$id)->update($data);
         return Helper::Result_bool($category);

     }



}