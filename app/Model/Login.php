<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $pk = "id";
    protected $table = "login";
    public $primaryKey='id';  
    protected $fillable = ['username','pwd',];
      /**打上时间戳 */
      public $timestamps = false;
}
