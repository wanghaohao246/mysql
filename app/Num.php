<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Num extends Model
{
      protected  $table = 'num';
    protected $primaryKey='u_id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
