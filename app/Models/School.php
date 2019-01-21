<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = [];
    protected $connection = "mysql2";
    protected $table = "users";
}
