<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleFiles extends Model
{
    public function lists()
    {
        return $this->belongsTo('App\Models\ContentList', 'list_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
