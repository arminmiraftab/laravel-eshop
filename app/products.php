<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
    protected $table = 'product';
    protected $primaryKey = 'Product_id';

    public function photo(){
        return $this->morphMany(image::class, 'images','images_type','images_id');
    }
    public function category(){
        return $this->hasOne(categorys::class,'category_id','category_id');
    }
    public function brand(){
        return $this->hasOne(manufactures::class,'manufacture_id','manufacture_id');
    }
    public function order_details()
    {
        return $this->hasMany(order_details::class,'Product_id','Product_id');
    }
    public function comment()
    {
        return $this->hasMany(commentsmol::class,'Product_id','Product_id');
    }
    public function color()
    {
        return $this->hasOne(colormodel::class,'color_id','color_id');
    }
    public function scopeActive($query)
    {
        return $query->where('Product_status', 1);
    }
    public function scopeActiverecommend($query)
    {
        return $query->where('recommended', 1);
    }
    public function scopeOfId($query,$id)
    {
        return $query->where('Product_id', $id);
    }


//    public function comments()
//    {
//        return $this->hasManyThrough(
//            order_details::class,
//            orders::class,
//            'customer_id', // Foreign key on the environments table...
//            'order_id', // Foreign key on the deployments table...
//            'Product_id', // Local key on the projects table...
//            'order_id' // Local key on the environments table...
//        );
//    }
}
