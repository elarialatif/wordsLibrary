<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use App\User;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ContentList extends Model
{

    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
