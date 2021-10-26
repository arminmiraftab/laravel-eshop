<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class shippings extends Model
{
    use softDeletes;
    protected $table = 'shipping';
    protected $dates=['deleted_at'];
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
