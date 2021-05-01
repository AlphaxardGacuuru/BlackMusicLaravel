<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'username', 'username');
    }

    public function post_comment_likes()
    {
        return $this->hasMany('App\PostCommentLikes', 'comment_id');
    }
}
