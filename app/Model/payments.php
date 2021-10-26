<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'user_id',
        'Product_id',

    ];

    public function product()
    {
        return $this->belongsTo(products::class, 'Product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
