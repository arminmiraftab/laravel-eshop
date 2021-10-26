<?php

namespace App\Model;

use App\Model\products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class colormodel extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
    protected $table = 'color';

}
