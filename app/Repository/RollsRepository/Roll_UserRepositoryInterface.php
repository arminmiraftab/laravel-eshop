<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\RollsRepository;


interface Roll_UserRepositoryInterface
{
    public function exists($user_id,$role_id);
    public function store($Request);

}