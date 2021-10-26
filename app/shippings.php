<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class shippings extends Model
{
    use softDeletes;
    protected $table = 'shipping';
    protected $dates=['deleted_at'];
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
//    public function Sendorder()
//    {
//        return $this->hasManyThrough(
//            order_details::class,
//            orders::class,
//
//
//            'shipping_id', // Foreign key on the environments table...
//            'order_id', // Foreign key on the deployments table...
//            'shipping_id', // Local key on the projects table...
//            'order_id' // Local key on the environments table...
//        );
//    }
//    public function user()
//    {
//        return $this->belongsTo(User::class,'customer_id');
//    }
}
