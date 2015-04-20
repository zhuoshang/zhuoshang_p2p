<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/4/18 下午8:48
*/

use App\Activity;
use App\ActivityPic;
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
                $url = $banner->url;
            }else{
                $url = '';
            }

            $activityData[] = array(
                'title'=>$list->title,
                'pic'=>asset($url),
                'clicks'=>$list->click,
                'words'=>strlen($list->content),
                'pics'=>count($list->pic)

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
