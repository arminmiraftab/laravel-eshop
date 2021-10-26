<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table = 'shipping';

    public function submenu()
    {
        return $this->hasMany(SubMenu::class);
    }

}
