<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'username', 'email', 'email_verified_at', 'password', 'remember_token', 'phone', 'gender', 'acc_type', 'acc_type_2', 'pp', 'pb', 'bio', 'dob', 'location', 'withdrawal',
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

    protected $primaryKey = 'user_id';

    public function posts()
    {
        return $this->hasMany('App\Post', 'username', 'username');
    }

    public function follow()
    {
        return $this->hasMany('App\Follow', 'username');
    }

    public function post_comments()
    {
        return $this->hasMany('App\PostComments', 'username', 'username');
    }

    public function decos()
    {
        return $this->hasMany('App\Decos', 'username', 'username');
    }
}
