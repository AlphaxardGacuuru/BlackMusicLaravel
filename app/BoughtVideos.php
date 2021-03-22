<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoughtVideos extends Model
{
    protected $primaryKey = "bought_video_id";

    public function videos()
    {
        return $this->belongsTo('App\Videos', 'video_id');
    }
}
