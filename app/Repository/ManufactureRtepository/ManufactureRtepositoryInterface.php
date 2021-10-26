<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\ManufactureRtepository;


interface ManufactureRtepositoryInterface
{
    public function all();
    public function show();
    public function test();
    public function store($data);
    public function delete($id);
    public function update_bottom($id);
    public function find_Manufacture($Manufacture_id);
    public function updates($data,$id);
}