<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_maunfactur extends Model
{
    protected $table = 'category_maunfacturees';
    protected $fillable = [
        'category_id', 'manufacture_id'
        ];

        public function category(){
            return $this->belongsTo(categorys::class,'category_id','category_id');
        }

}
