<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    protected $fillable = [
        'state_fa','order_id','	Product_id','Product_name'
        ,'Product_price','Product_sales_quantity','customer_id',
        'time_fa','	created_at'
    ];
    protected $table = 'order_details';

    public function order_details()
    {
        return $this->belongsTo(products::class,'product_id','product_id');
    }
    public function order()
    {
        return $this->belongsTo(orders::class,'order_id','order_id');
    }
    public function order_photo(){
        return $this->hasOne(image::class,'images_id','Product_id')
            ->where('images_type',products::class)->where('first_photo',1);
    }

}
