<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\ShippingRepository;


interface ShippingRepositoryInterface
{

    public function store($Request);
    public function find($id);
    public function find_all();
    public function delete($id);

}