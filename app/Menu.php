<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use softDeletes;
    protected $dates=['deleted_at'];
    public function submenu()
    {
            return $this->hasMany(SubMenu::class);
    }
}
