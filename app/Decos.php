<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decos extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'username', 'username');
    }
}
