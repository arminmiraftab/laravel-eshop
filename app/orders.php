<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'order';
    public function order_details()
    {
        return $this->hasMany(order_details::class,'order_id','order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'customer_id');
    }
    public function address()
    {
        return $this->hasOne(shippings::class,'shipping_id','shipping_id');
    }

    public function scopeOfId($query,$id)
    {
        return $query->where('Product_id', $id);
    }



}
