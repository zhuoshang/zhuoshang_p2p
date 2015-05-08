<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/4/18 下午8:48
*/

use App\Activity;
use App\ActivityOrder;
use App\ActivityPic;
use App\Charity;
use App\CharityOrder;
use App\CharityPic;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Auth;
use Cache;

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
            $end = strtotime($list->created_at) + $list->time*60*60*24;

            $now = time();
            if(($now - $begin)/60/60/24 < $list->time){
                $status = 1;
            }else{
                $status = 0;
            }

            $activityData[] = array(
                'id'=>$list->id,
                'title'=>$list->title,
                'pic'=>$url,
                'clicks'=>$list->click,
                'words'=>strlen($list->content),
                'pics'=>count($list->pic),
                'begin'=>date('Y-m-d',$begin),
                'end'=>date('Y-m-d',$end),
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
            $end = strtotime($list->created_at) + $list->time*60*60*24;

            $now = time();
            if(($now - $begin)/60/60/24 < $list->time){
                $status = 1;
            }else{
                $status = 0;
            }

            $charityData[] = array(
                'id'=>$list->id,
                'title'=>$list->title,
                'pic'=>$url,
                'clicks'=>$list->click,
                'words'=>strlen($list->content),
                'pics'=>count($list->pic),
                'begin'=>date('Y-m-d',$begin),
                'end'=>date('Y-m-d',$end),
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
     * 贵宾优享详情
     **/
    public function activityContent(Request $request){
        $id = $request->input('id');
        if(!is_numeric($id)){
            $this->throwERROE(500,'id违法');
        }

        $activityData = Activity::find($id);
        if($activityData == ''){
            $this->throwERROE(501,'id不存在');
        }

        $begin = strtotime($activityData->created_at);
        $end = strtotime($activityData->created_at) + $activityData->time*60*60*24;

        $now = time();
        if(($now - $begin)/60/60/24 < $activityData->time){
            $status = 1;
        }else{
            $status = 0;
        }

        $activityData->click+=1;
        $activityData->save();

        $contentData = array();

        $contentData = array(
            'title'=>$activityData->title,
            'content'=>$activityData->content,
            'begin'=>date('Y-m-d',$begin),
            'end'=>date('Y-m-d',$end),
            'click'=>$activityData->click,
            'words'=>strlen($activityData->content),
            'pics'=>count($activityData->pic),
            'status'=>$status
        );

        if($activityData->pic != ''){
            foreach($activityData->pic as $picture){
                if($picture->isbanner == 0){
                    $contentData['pic'][] = asset($picture->url);
                }
            }
        }


        echo json_encode(array(
            'status'=>200,
            'msg'=>'ok',
            'data'=>$contentData
        ));

        exit();

    }



    /*
     * 爱心捐赠详情
     **/
    public function charityContent(Request $requset){

        $id = $requset->input('id');

        if(!is_numeric($id)){
            $this->throwERROE(500,'id违法');
        }

        $charityData = Charity::find($id);
        if($charityData == ''){
            $this->throwERROE(501,'id不存在');
        }

        $begin = strtotime($charityData->created_at);
        $end = strtotime($charityData->created_at) + $charityData->time*60*60*24;

        $now = time();
        if(($now - $begin)/60/60/24 < $charityData->time){
            $status = 1;
        }else{
            $status = 0;
        }

        $charityData->click+=1;
        $charityData->save();

        $charityContent = array();
        $charityContent = array(
            'title'=>$charityData->title,
            'content'=>$charityData->content,
            'begin'=>date('Y-m-d',$begin),
            'end'=>date('Y-m-d',$end),
            'click'=>$charityData->click,
            'words'=>strlen($charityData->content),
            'pics'=>count($charityData->pic),
            'status'=>$status
        );

        if($charityData->pic != ''){
            foreach($charityData->pic as $picture){
                if($picture->isbanner == 0){
                    $charityContent['pic'][] = $picture->url;
                }
            }
        }

        echo json_encode(array(
            'status'=>200,
            'msg'=>'',
            'data'=>$charityContent
        ));

        exit();
    }


    /*
     * 爱心及优享预约
     **/
    public function acOrder(Request $request){
        $option = $request->input('option');
        $id = $request->input('id');
        $sum = $request->input('money');
        $checkCode = $request->checkCode;//获取验证码

        if(!is_numeric($id) || !is_numeric($sum)){
            $this->throwERROE(500,'数据违法');
        }

        //短信验证码验证
        $ip = $this->getIP();
        $mobile = Auth::user()->mobile;

        $key = md5('order'.$mobile.$ip);
        $code = Cache::get($key);
        if($checkCode != $code || $checkCode == ''){
            $this->throwERROE(505,'验证码错误');
        }


        if($option == 'charity'){
            $charity = Charity::find($id);
            if($charity == ''){
                $this->throwERROE(501,'活动不存在');
            }

            $order = new CharityOrder();
            $order->uid = Auth::user()->front_uid;
            $order->cid = $id;
            $order->sum = $sum;
            if($order->save()){

                echo json_encode(array(
                    'status'=>200,
                    'msg'=>'ok',
                    'data'=>''
                ));

                exit();
            }else{
                $this->throwERROE(502,'save_error');
            }

        }elseif($option == 'activity'){
            $activity = Activity::find($id);
            if($activity == ''){
                $this->throwERROE(501,'活动不存在');
            }

            $order = new ActivityOrder();
            $order->uid = Auth::user()->front_uid;
            $order->aid = $id;
            $order->sum = $sum;
            if($order->save()){

                echo json_encode(array(
                    'status'=>200,
                    'msg'=>'ok',
                    'data'=>''
                ));

                exit();
            }else{
                $this->throwERROE(502,'save_error');
            }

        }else{
            $this->throwERROE(503,'操作不存在');
        }
    }



    /*
     * 贵宾优享及爱心捐赠明细
     **/
    public function acDetail(Request $request){
        $option = $request->option;
        $details = array();

        if($option == 'activity'){
            $details = ActivityOrder::all();

            $detailData = array();
            foreach($details as $key=>$detail){
                $key++;
                $time = date('Y/m/d',strtotime($detail->updated_at));

                $detailData[] = array(
                    'id'=>$key,
                    'user'=>$detail->user->real_name,
                    'method'=>'线下支付',
                    'sum'=>$detail->sum,
                    'time'=>$time,
                    'remark'=>$detail->remark,
                );
            }

        }elseif($option == 'charity'){
            $details = CharityOrder::all();

            $detailData = array();
            foreach($details as $key=>$detail){
                $key++;
                $time = date('Y/m/d',strtotime($detail->updated_at));

                $detailData[] = array(
                    'id'=>$key,
                    'user'=>$detail->user->real_name,
                    'method'=>'线下支付',
                    'sum'=>$detail->sum,
                    'time'=>$time,
                    'remark'=>$detail->remark,
                );
            }

        }else{
            $this->throwERROE(501,'操作不存在');
        }

        echo json_encode(array(
            'status'=>200,
            'msg'=>'ok',
            'data'=>$detailData

        ));

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


    /*
    *  获取客户端ip地址
    **/
    private function getIP(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "无法获取！";
        }
        return $cip;
    }

}
