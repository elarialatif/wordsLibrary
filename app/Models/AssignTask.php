<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;

class AssignTask extends Model
{
    protected $guarded = [];

    public function lists()
    {
        return $this->belongsTo('App\Models\ContentList', 'list_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        AssignTask::observe(UserActionsObserver::class);
    }
}
