<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    protected $pk = "id";
    protected $table = "index";
    public $primaryKey='id';  
    protected $fillable = ['username','pwd',];
      /**打上时间戳 */
      public $timestamps = false;
}
