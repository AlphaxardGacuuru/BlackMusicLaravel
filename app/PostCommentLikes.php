<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCommentLikes extends Model
{
    public function post_comments()
    {
        return $this->belongsTo('App\PostComments', 'comment_id');
    }

    public function post_comment_likes()
    {
        return $this->hasMany('App\PostComments', 'comment_id');
    }
}
