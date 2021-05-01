<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
    public function posts()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
