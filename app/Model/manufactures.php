<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class manufactures extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
    protected $table = 'manufacture';

    public function category(){
        return $this->belongsToMany(categorys::class, 'category_maunfacturees','maunfacturees_id','category_id');
    }
}
