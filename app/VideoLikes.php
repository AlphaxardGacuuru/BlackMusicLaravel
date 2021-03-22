<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoLikes extends Model
{
    public function videos()
    {
        return $this->belongsTo('App\Videos');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
