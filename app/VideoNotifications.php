<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoNotifications extends Model
{
    protected $primaryKey = "vn_id";

    public function videos()
    {
        return $this->belongsTo('App\Videos', 'id', 'id');
    }
}
