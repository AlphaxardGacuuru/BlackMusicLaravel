<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    public function bought_videos()
    {
        return $this->hasMany('App\BoughtVideos', 'video_id', 'id');
    }

    public function cart_videos()
    {
        return $this->hasMany('App\CartVideos', 'video_id', 'id');
    }

    public function video_likes()
    {
        return $this->hasMany('App\VideoLikes', 'video_id', 'id');
    }

    public function video_notifications()
    {
        return $this->hasMany('App\VideoNotifications', 'video_id', 'id');
    }

    public function video_albums()
    {
        return $this->belongsTo('App\VideoAlbums', 'album');
    }
}
