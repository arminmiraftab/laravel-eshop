<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\UserRepository;


interface UserRtepositoryInterface
{

    public function show();
    public function test();
    public function find($id);
    public function update_Column($id,$Column,$chenge);
    public function update($request,$id);
    public function update_admin($id,$Request);
    public function delete($id);
    public function delete_admin($id);
    public function exists($user_id,$role_id);
//    public function Update_Roll($user_id,$role_id);
    public function Roll_store($user_id);
    function Roll_Fetch();
    function Roll_admin_Fetch();
    function Roll_Find($id);
    function Roll_Edite($id);
    function user_select();
    function count();


}