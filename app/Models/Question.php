<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected  $guarded=[];
    protected  $table='questions';
    public function lists()
    {
        return $this->belongsTo(ContentList::class, 'list_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function artical()
    {
        return $this->belongsTo(Article::class, 'artical_id', 'id');
    }
}
