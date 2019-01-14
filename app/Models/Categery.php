<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;


class Categery extends Model
{

    protected $table = "categories";

    //each category might have one parent
    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent_id');
    }

    //each category might have multiple children
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy('name', 'asc');
    }

    public static function boot()
    {
        parent::boot();

        Categery::observe(UserActionsObserver::class);
    }

}
