<?php

namespace App\Http\Controllers\test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class test extends Controller
{
    public $dsds;

    public function __construct($dsds)
    {
        $this->dsds = $dsds;
    }
    public function pay(){
        return [
            "pay"=> "56"
        ];
    }
}
