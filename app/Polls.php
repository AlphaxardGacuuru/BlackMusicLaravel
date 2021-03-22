<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
    protected $primaryKey = "poll_id";

    public function posts()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
