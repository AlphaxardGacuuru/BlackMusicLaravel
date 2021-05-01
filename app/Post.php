<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'username', 'username');
    }

    public function post_likes()
    {
        return $this->hasMany('App\PostLikes', 'post_id');
    }

    public function post_comments()
    {
        return $this->hasMany('App\PostComments', 'post_id');
    }

    public function polls()
    {
        return $this->hasMany('App\Polls', 'post_id');
    }
}
