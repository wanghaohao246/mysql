<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinpai extends Model
{
    protected  $table = 'pinpai';
    protected $primaryKey='b_id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
