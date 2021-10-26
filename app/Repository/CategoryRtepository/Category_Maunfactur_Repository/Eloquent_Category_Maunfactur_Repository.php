<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 09.09.2021
 * Time: 18:35
 */

namespace App\Repository\CategoryRtepository\Category_Maunfactur_Repository;


use App\category_maunfactur;

class Eloquent_Category_Maunfactur_Repository implements Category_Maunfactur_Repository_Interface
{
    public function category_id($id){
        return category_maunfactur::where('manufacture_id',$id)->select('category_id')->pluck('category_id');
    }
     public function all($id){
            return category_maunfactur::with('category')->where('manufacture_id',$id)->select('category_id','manufacture_id')->get();
        }
    public function store($request){
        $category_maunfactur=new category_maunfactur;
        $category_maunfactur->category_id = $request->cat_id  ;
        $category_maunfactur->manufacture_id = $request->manufacture_id ;
        $category_maunfactur->save();
    }
    public function destroy($request){
        return category_maunfactur::where('manufacture_id',$request->manufacture_id)->where('category_id',$request->cat_id)->first()->delete();

        }
    public function serch_brand($request){
       return category_maunfactur:: where('category_maunfacturees.category_id',$request->cat_id)
            ->join('manufacture','category_maunfacturees.manufacture_id','manufacture.manufacture_id')
            ->join('category','category_maunfacturees.category_id','category.category_id')
            ->pluck( 'manufacture.manufacture_name' ,'manufacture.manufacture_id');
            }

}