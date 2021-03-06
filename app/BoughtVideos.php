<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoughtVideos extends Model
{
    public function videos()
    {
        return $this->belongsTo('App\Videos', 'video_id');
    }
}
