<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/4/30 下午3:24
*/

use App\User;
use App\FrontUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Cache;

class SmsController extends Controller{

    private $apiKey = 'c7b2236228e9d5d58e771792f27eaef9';

    /*
     * 短信发送接口
     **/
    public function smsSent(Request $request){
        $option = $request->option;
        $mobile = $request->phoneNumber;

        //手机号格式验证
        if(!$this->mobileCheck($mobile)){
            $this->throwERROE(500,'手机号格式错误');
        }

        $ip = $this->getIP();

        if($option == 'register'){
            $code = rand(100000,999999);
            $key = md5('register'.$mobile.$ip);

            Cache::put($key,$code,30);

            $this->Bssend($code,$mobile);

        }
    }


    /*
     * 发送操作
     **/
    private function Bssend($code,$mobile){
        $tpl_id = 772799; //对应默认模板 【#company#】您的验证码是#code#
        $tpl_value = "#code#=".$code;
        $send = $this->tpl_send_sms($this->apiKey,$tpl_id, $tpl_value, $mobile);

        $send = json_decode($send);
        if($send->code == 0){
            echo json_encode(array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>''
            ));

            exit();

        }else{
            $this->throwERROE(509,'yunpian_error');
        }


    }


    /*
     * 云片模板接口发送短信
     **/
    private function tpl_send_sms($apikey, $tpl_id, $tpl_value, $mobile){
        $url="http://yunpian.com/v1/sms/tpl_send.json";
        $encoded_tpl_value = urlencode("$tpl_value");  //tpl_value需整体转义
        $post_string="apikey=$apikey&tpl_id=$tpl_id&tpl_value=$encoded_tpl_value&mobile=$mobile";
        return $this->sock_post($url, $post_string);
    }


    /*
     * 云片接口直接发送短信
     **/
    private function send_sms($apikey, $text, $mobile){
        $url="http://yunpian.com/v1/sms/send.json";
        $encoded_text = urlencode("$text");
        $post_string="apikey=$apikey&text=$encoded_text&mobile=$mobile";
        return $this->sock_post($url, $post_string);
    }



    /**
     * url 为服务的url地址
     * query 为请求串
     */
    private function sock_post($url,$query){
        $data = "";
        $info=parse_url($url);
        $fp=fsockopen($info["host"],80,$errno,$errstr,30);
        if(!$fp){
            return $data;
        }
        $head="POST ".$info['path']." HTTP/1.0\r\n";
        $head.="Host: ".$info['host']."\r\n";
        $head.="Referer: http://".$info['host'].$info['path']."\r\n";
        $head.="Content-type: application/x-www-form-urlencoded\r\n";
        $head.="Content-Length: ".strlen(trim($query))."\r\n";
        $head.="\r\n";
        $head.=trim($query);
        $write=fputs($fp,$head);
        $header = "";
        while ($str = trim(fgets($fp,4096))) {
            $header.=$str;
        }
        while (!feof($fp)) {
            $data .= fgets($fp,4096);
        }
        return $data;
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



    /*
     * 国内手机号认证
     **/
    private function mobileCheck($mobile){
        if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$mobile)){
            return true;

        }else{
            return false;
        }
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