<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class commentsmol extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
    protected $table = 'comments';

//    public function customer(){
//
//        return $this->belongsTo(customer::class);
//
//    }
    public function comment_photo(){
        return $this->hasOne(image::class,'images_id','Product_id')
            ->where('images_type',products::class)->where('first_photo',1);
    }
    public function prodoct()
    {
        return $this->belongsTo(products::class,'Product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'customer_id');
    }
    public function scopeOfIdProduct($query,$id)
    {
        return $query->where('Product_id', $id);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
