<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class role_user extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
}
