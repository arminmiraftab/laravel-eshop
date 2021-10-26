<?php

namespace App;

use App\model\Transactions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

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
        return $this->belongsTo(role::class, 'roll_id');
    }
    public function roll(){
        return $this->hasOne(role::class, 'id','roll_id');
    }
    public function hasAnyRoles(string $Role){
        return null !==$this->roles()->where('name',$Role)->first();
    }
    public function comment()
    {
        return $this->hasMany(commentsmol::class,'id');
    }
    public function order()
    {
        return $this->hasMany(orders::class,'customer_id','id');
    }

    public function payments()
    {
        return $this->hasMany(Transactions::class, 'user_id');
    }
    public function purchased()
    {
        return $this->hasMany(payments::class, 'user_id');
    }

    //    public function order()
//    {
//        return $this->hasMany(orders::class,'customer_id','id');
//    }
    public function scopeOfId($query,$id)
    {
        return $query->where('id', $id);
    }
}
