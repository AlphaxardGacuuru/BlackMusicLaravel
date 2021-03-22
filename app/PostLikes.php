<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLikes extends Model
{
    protected $primaryKey = 'post_like_id';

    public function posts()
    {
        $this->belongsTo('App\Post', 'post_id');
    }
}
