<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLikes extends Model
{
    public function posts()
    {
        $this->belongsTo('App\Post', 'post_id');
    }
}
