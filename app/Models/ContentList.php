<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;


class ContentList extends Model
{
    protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public static function boot()
    {
        parent::boot();

        ContentList::observe(UserActionsObserver::class);
    }
//    public function country()
//    {
//        return $this->belongsTo(Country::class, 'country_id');
//    }

}
