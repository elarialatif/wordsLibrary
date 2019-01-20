<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use App\User;
use Illuminate\Database\Eloquent\Model;

class PlacementTest extends Model
{
    protected $guarded=[];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');

}


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function boot()
    {
        parent::boot();

        PlacementTest::observe(UserActionsObserver::class);
    }
}
