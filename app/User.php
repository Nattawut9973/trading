<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yarob\LaravelExpirable\Expirable;

class User extends Authenticatable
{
    use Expirable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'age', 'image', 'tel', 'event_id', 'role_id', 'amount_order', 'sum', 'result'
    ];

    protected $dates = ['expire_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }


    public function userMessages()
    {
        return $this->hasMany(UserMessage::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function autoSells()
    {
        return $this->hasMany(AutoSell::class);
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'event_id','id');
    }

}
