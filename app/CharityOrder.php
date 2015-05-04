<?php namespace App;
/*
**Author:tianling
**createTime:15/4/29 下午4:21
*/

use Illuminate\Database\Eloquent\Model;

class CharityOrder extends Model{
    protected $table = 'charityOrder';

//    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\FrontUser','uid','front_uid');
    }
}