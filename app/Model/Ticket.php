<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'channel_id';
    public $incrementing = false;
    protected $guarded = [];
}
