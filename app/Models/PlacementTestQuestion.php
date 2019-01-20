<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;

class PlacementTestQuestion extends Model
{
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public static function boot()
    {
        parent::boot();
        PlacementTestQuestion::observe(UserActionsObserver::class);
    }
}
