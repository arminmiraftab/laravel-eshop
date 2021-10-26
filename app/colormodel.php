<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class colormodel extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
    protected $table = 'color';
    public function scopeOfId($query,$id)
    {
        return $query->where('Product_id', $id);
    }
}
