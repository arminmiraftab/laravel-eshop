<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'payment_method',
        'user_id',
        'Product_id',
    ];

    public function product()
    {
        return $this->belongsTo(\App\Model\products::class, 'Product_id');
    }

}