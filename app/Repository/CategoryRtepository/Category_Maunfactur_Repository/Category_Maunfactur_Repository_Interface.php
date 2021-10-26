<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 09.09.2021
 * Time: 18:36
 */

namespace App\Repository\CategoryRtepository\Category_Maunfactur_Repository;


interface Category_Maunfactur_Repository_Interface
{
    public function category_id($id);
    public function all($id);
    public function store($id);
    public function destroy($request);
    public function serch_brand($request);

}