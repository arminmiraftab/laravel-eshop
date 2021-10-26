<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sliders extends Model
{
    use softDeletes;
    protected $fillable = [
        'images_id',
        'images_type',
        'imageable_path',
    ];
    protected $dates=['deleted_at'];
    protected $table = 'slider';
    public function photo(){
        return $this->morphMany(image::class, 'images','images_type','images_id','slider_id');
    }
    public function scopeOfId($query,$id)
    {
        return $query->where('slider_id', $id);
    }
}
