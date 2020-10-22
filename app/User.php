<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
<<<<<<< HEAD
=======
 
    use SoftDeletes;
 
>>>>>>> 5ff9e506ed96118b2e61bf6bdd923ef1a91c1047

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< HEAD

=======
 
>>>>>>> 5ff9e506ed96118b2e61bf6bdd923ef1a91c1047
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function favorites()
    {
        return $this->hasMany('App\favorite');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
<<<<<<< HEAD
=======
 
>>>>>>> 5ff9e506ed96118b2e61bf6bdd923ef1a91c1047
}
