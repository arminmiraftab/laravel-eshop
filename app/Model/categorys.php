<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categorys extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];

    protected $table = 'category';

    public function brands(){
        return $this->belongsToMany(manufactures::class,'category_maunfacturees','category_id','manufacture_id','category_id','manufacture_id');
    }
    public function scopeActive($query)
    {
        return $query->where('category_status', 1);
    }
}
