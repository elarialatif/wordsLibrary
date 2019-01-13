<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Article extends Model
{
    protected $table = 'article';

    public function lists()
    {
        return $this->belongsTo('App\Models\ContentList', 'list_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
