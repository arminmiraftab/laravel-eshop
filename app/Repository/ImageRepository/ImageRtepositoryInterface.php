<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\ImageRepository;


interface ImageRtepositoryInterface
{
    public function find($id);
    public function store($vlaue);
    public function update($request);


}