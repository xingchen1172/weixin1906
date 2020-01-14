<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $pk = "media_id";
    protected $table = "media";
    // public $primaryKey='media_id';  
    protected $guarded = [];
      /**打上时间戳 */
      public $timestamps = false;
}
