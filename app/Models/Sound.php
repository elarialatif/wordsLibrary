<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        Sound::observe(UserActionsObserver::class);
    }
}
