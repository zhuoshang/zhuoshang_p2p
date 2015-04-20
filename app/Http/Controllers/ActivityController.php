<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/4/18 下午8:48
*/

use App\Activity;
use App\ActivityPic;
use App\Charity;
use App\CharityPic;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Auth;

class ActivityController extends Controller{

    /*
     * 贵宾优享列表
     **/
    public function activityList(){

        $activityList = Activity::orderBy('created_at','DESC')->get();

        $activityData = array();
        foreach($activityList as $list){

            $banner = ActivityPic::where('aid','=',$list->id)
                ->where('isbanner','=','1')
                ->first();
            if($banner != ''){
                $url = asset($banner->url);
            }else{
                $url = '';
            }

            $begin = strtotime($list->created_at);
            $now = time();
            if(($now - $begin)/60/60/24 < $list->time){
                $status = 1;
            }else{
                $status = 0;
            }

            $activityData[] = array(
                'title'=>$list->title,
                'pic'=>$url,
                'clicks'=>$list->click,
                'words'=>strlen($list->content),
                'pics'=>count($list->pic),
                'status'=>$status

            );


        }

        echo json_encode(
            array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>$activityData
            )
        );

        exit();

    }



    /*
     * 爱心捐赠列表
     **/
    public function charityList(){
        $charityList = Charity::orderBy('created_at','DESC')->get();

        $charityData = array();
        foreach($charityList as $list){

            $banner = CharityPic::where('cid','=',$list->id)
                ->where('isbanner','=','1')
                ->first();
            if($banner != ''){
                $url = asset($banner->url);
            }else{
                $url = '';
            }

            $begin = strtotime($list->created_at);
            $now = time();
            if(($now - $begin)/60/60/24 < $list->time){
                $status = 1;
            }else{
                $status = 0;
            }

            $charityData[] = array(
                'title'=>$list->title,
                'pic'=>$url,
                'clicks'=>$list->click,
                'words'=>strlen($list->content),
                'pics'=>count($list->pic),
                'status'=>$status

            );


        }

        echo json_encode(
            array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>$charityData
            )
        );

        exit();
    }




    /*
     * 抛错函数
     **/
    private function throwERROE($code,$msg){
        echo json_encode(array(
            'status'=>$code,
            'msg'=>$msg,
            'data'=>''
        ));

        exit();
    }
}
