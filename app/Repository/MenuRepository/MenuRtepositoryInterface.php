<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\MenuRepository;


interface MenuRtepositoryInterface{
    public function show();
    public function test();
    public function store($Request);
    public function store_sub_menus($Request);
    public function find($id);
}