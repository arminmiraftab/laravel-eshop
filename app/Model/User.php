<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'last_name','National_Code'
        ,'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role', 'role_users');
    }
    public function hasAnyRoles(string $Role){
        return null !==$this->roles()->where('name',$Role)->first();
    }
    public function comment()
    {
        return $this->hasMany(commentsmol::class,'id');
    }

    public function payments()
    {
        return $this->hasMany(payments::class, 'user_id');
    }
    public function purchased()
    {
        return $this->hasMany(payments::class, 'user_id');
    }
}
