<?php namespace App;
/*
**Author:tianling
**createTime:15/4/29 下午4:31
*/


use Illuminate\Database\Eloquent\Model;

class ActivityOrder extends Model{
    protected $table = 'activityOrder';

//    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\FrontUser','uid','front_uid');
    }
}