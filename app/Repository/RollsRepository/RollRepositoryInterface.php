<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\RollsRepository;


interface RollRepositoryInterface
{
    public function all();
    public function show();
    public function find($id);

}