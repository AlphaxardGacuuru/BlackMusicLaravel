<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoComments extends Model
{
    protected $primaryKey = "video_comment_id";

    public function videos()
    {
        return $this->belongsTo('App\Videos');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'username', 'username');
    }

    public function video_comment_likes()
    {
        return $this->hasMany('App\VideoCommentLikes', 'video_comment_id', 'video_comment_id');
    }
}
