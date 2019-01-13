<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
protected $guarded=[];
    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }

}
