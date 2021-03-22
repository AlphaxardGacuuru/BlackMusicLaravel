<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartVideos extends Model
{
    protected $primaryKey = "cart_video_id";

    public function videos()
    {
        return $this->belongsTo('App\Videos', 'video_id');
    }
}
