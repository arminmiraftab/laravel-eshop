<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admins extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'roll_id', 'is_super',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsTo(role::class, 'roll_id');
    }
    public function roll(){
        return $this->hasOne(role::class, 'id','roll_id');
    }
    public function hasAnyRoles(string $Role){
        return null !==$this->roles()->where('name',$Role)->first();
    }
    public function scopeOfId($query,$id)
    {
        return $query->where('id', $id);
    }
}
