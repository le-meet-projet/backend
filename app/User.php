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
>>>>>>> c0f64b4bc023dc8e407eb5285d8456332ae169a9

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
>>>>>>> c0f64b4bc023dc8e407eb5285d8456332ae169a9
}
