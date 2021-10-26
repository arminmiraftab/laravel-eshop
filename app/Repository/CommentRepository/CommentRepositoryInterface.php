<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\CommentRepository;


interface CommentRepositoryInterface
{
    public function all();
    public function store($vlaue,$id);
    public function find($id);
    public function confirm_Comments($vlaue);
    public function comment_product($id);

}