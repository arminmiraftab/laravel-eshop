<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\ProductsRtepository;


interface ProductsRtepositoryInterface
{

    public function show();
    public function store($Request);
    public function find($id);
    public function update_Column($id,$Column,$chenge);
    public function find_product($id);
    public function find_detail($id);
    public function find_detail_manufacture($id);
    public function find_detail_Category($id);
    public function find_detail_color($id);
    public function update($request,$id);
    public function delete($id);
    function update_bottom ($id);
    function update_bottom_recommended ($id);
    function all();
    public function Product_photo();
    public function Factor($id);
    public function Product_add_cart($id);
    public function Product_find_photo($id);
    public function count();
    public function recommended();
    public function find_all_order($id);



}