<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListCategory extends Model
{
    public function list()
    {
        return $this->belongsTo(ContentList::class, 'list_id');
    }

    public function catg()
    {
        return $this->belongsTo(Categery::class, 'cat_id');
    }
}
