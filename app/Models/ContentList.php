<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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

//    public function country()
//    {
//        return $this->belongsTo(Country::class, 'country_id');
//    }

}
