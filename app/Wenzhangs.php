<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wenzhangs extends Model
{
    protected  $table = 'wenzhang';
    protected $primaryKey='id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
