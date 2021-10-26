<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sliders extends Model
{
    use softDeletes;
    protected $fillable = [
        'sub_category_slider',
        'category_slider',
        'detal_slider',
        'submit_slider',
        'submit_link',
        'slider_status',
    ];
    protected $dates=['deleted_at'];
    protected $table = 'slider';
    public function photo(){
        return $this->morphMany('App\image', 'images','images_type','images_id','slider_id');
    }
    public function scopeOfId($query,$id)
    {
        return $query->where('slider_id', $id);
    }
    public function scopeactive($query)
    {
        return $query->where('slider_status', 1);
    }
}
