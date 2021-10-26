<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\UserRepository\AdminRepository;


interface AdminRepositoryInterface
{

//    public function show();
    public function test();
//    public function store($Request);
    public function find($id);
//    public function update_Column($id,$Column,$chenge);
    public function update($id,$request);
//    public function update_admin($id,$Request);
    public function delete($id);
//    public function delete_admin($id);
    public function exists($user_id,$role_id);

//    public function Update_Roll($user_id,$role_id);
    function Roll_store($Request,$roll);
//    function Roll_admin_Fetch();
//    function Roll_Find($id);
    function Roll_Edite($id);
//    function user_select();
//    function count();


}