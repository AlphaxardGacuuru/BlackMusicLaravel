<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoNotifications extends Model
{
    public function videos()
    {
        return $this->belongsTo('App\Videos');
    }
}
