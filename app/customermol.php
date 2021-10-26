<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customermol extends Model
{
    protected $table = 'customer';

    public function comments(){
        return $this->hasMany(comments::class);
    }
    public function shipp()
    {
        return $this->hasMany(shippings::class);
    }
}
