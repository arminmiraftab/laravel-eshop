<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'order';
    public function order_details()
    {
        return $this->hasMany(order_details::class,'order_id','order_id');
    }

}
