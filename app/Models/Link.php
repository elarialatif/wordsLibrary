<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $guarded=[];

    public function lists()
    {
        return $this->belongsTo('App\Models\ContentList', 'list_id', 'id');
    }
}
