<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCommentLikes extends Model
{
    protected $primaryKey = 'post_comment_like_id';

    public function post_comments()
    {
        return $this->belongsTo('App\PostComments', 'post_comment_id');
    }

    public function post_comment_likes()
    {
        return $this->hasMany('App\PostComments', 'post_comment_id');
    }
}
