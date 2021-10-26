<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class role extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
    public function users(){
        return $this->belongsToMany('App\user', 'role_users');
    }
}
