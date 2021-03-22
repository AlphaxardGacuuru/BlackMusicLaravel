<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audios extends Model
{
    protected function bought_audios()
    {
        return $this->hasMany('App\BoughtAudios', 'audio_id');
    }

    protected function audio_likes()
    {
        return $this->hasMany('App\AudioLikes', 'audio_id');
    }

    protected function audio_albums()
    {
        return $this->belongsTo('App\AudioAlbums', 'album');
    }
}
