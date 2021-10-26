<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 15.08.2021
 * Time: 16:07
 */

namespace App\Repository\SliderRepository;


interface SliderRepositoryInterface
{
    public function all();
    public function show();
    public function store($Request);
    public function find($id);
    public function update_Column($id,$Column,$chenge);
    public function update($id,$request);
    public function delete($id);
    function update_bottom ($id);

}