<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;

class PlacementTestQuestion extends Model
{
    protected $guarded=[];
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function PlacementTest()
    {
        return $this->belongsTo(PlacementTest::class, 'exam_id');
    }
    public static function boot()
    {
        parent::boot();
        PlacementTestQuestion::observe(UserActionsObserver::class);
    }
}
