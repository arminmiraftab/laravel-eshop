<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\CategoryRtepository;


interface CategoryRtepositoryInterface
{
    public function all();
//    public function find();
    public function show();
    public function store($vlaue);
    public function find_Category($id);
    public function updates($id,$data);
    public function delete($id);
    public function update_bottom($id);
    public function update_Category($id,$value);
    public function brand();
    public function category_brand($id);

}