<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;

class ListCategory extends Model
{
    public function list()
    {
        return $this->belongsTo(ContentList::class, 'list_id');
    }

    public function catg()
    {
        return $this->belongsTo(Categery::class, 'cat_id');
    }

    public static function boot()
    {
        parent::boot();

        ListCategory::observe(UserActionsObserver::class);
    }
}
