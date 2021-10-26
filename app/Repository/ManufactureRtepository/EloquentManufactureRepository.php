<?php



namespace App\Repository\ManufactureRtepository;


use App\category_maunfactur;
use App\Helper\Helper;
use App\manufactures;
use App\Repository\baseEloquent;


/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentManufactureRepository implements ManufactureRtepositoryInterface
{
    use baseEloquent;
    /**
     * @var manufactures
     */
    protected $model;
    protected  $status='manufacture_status';

    public function __construct(manufactures $model)
    {
        $this->modle = $model;
    }
    public function all(){
        $manufactures=$this->modle::orderBy('manufacture_id', 'desc')->get();
        return Helper::Result_exist($manufactures);
    }
     public function show(){
         $Manufacture=$this->modle::where('manufacture_status',1)->get();
         return Helper::Result_exist($Manufacture);
        }
    public function test(){
        return "ok";
    }
    public function store($Request){

        $data = new manufactures;
        $data->manufacture_name = $Request->name;
        $data->manufacture_description = $Request->description;
        ($Request->manufacture_status == NULL) ? $data->manufacture_status= 0 : $data->manufacture_status = $Request->manufacture_status;
        $data->save();
        $category_maunfactur=new category_maunfactur;
        $category_maunfactur->category_id = $Request->category_id;
        $category_maunfactur->manufacture_id = $data->id;
       $Manufacture= $category_maunfactur->save();
        return Helper::Result_bool($Manufacture);
    }
    public function find_Manufacture($Manufacture_id){
        return  $this->modle::where('manufacture_id',$Manufacture_id)->first();
    }
    function update_bottom ($id){
        $Manufacture_find =$this->find_Manufacture($id);
     return $this->update_toggle($Manufacture_find,$this->status) ?
            $this->update_Column($id,$this->status,0) :
            $this->update_Column($id,$this->status,1);

    }
    public function update_Column($id,$Column,$chenge){
        $Manufacture=$this->modle::where('manufacture_id',$id)->update([$Column => $chenge]);
        return Helper::Result_bool($Manufacture);
    }
    public function delete($id):bool {
        $Manufacture=$this->modle::where('manufacture_id',$id)->delete();
        return Helper::Result_bool($Manufacture);
    }
    public function updates($request,$manufacture_id){
        $data=array();
        $data['manufacture_name']=$request->name_manufacture;
        $data['manufacture_description']=$request->description_manufacture;
        $Manufacture=$this->modle::where('manufacture_id',$manufacture_id)->update($data);
        return Helper::Result_bool($Manufacture);

    }
}