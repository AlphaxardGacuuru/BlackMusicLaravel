<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioAlbums extends Model
{

    protected function audios()
    {
        return $this->hasMany('App\Audios');
    }
}
