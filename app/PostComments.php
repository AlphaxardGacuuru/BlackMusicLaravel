<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    protected $primaryKey = "post_comment_id";

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
        return $this->hasMany('App\PostCommentLikes', 'post_comment_id');
    }
}
