<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $fillable = [
        'imageable_path','imageable_alt','images_id'
    ];

    public function photo()
    {
        return $this->morphTo();
    }
}
