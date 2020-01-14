<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'new';
    protected $primaryKey = 'new_id';
    public $incrementing = false;
    protected $guarded = [];
}
