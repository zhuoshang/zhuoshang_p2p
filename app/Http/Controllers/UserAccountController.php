<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/4/5 下午7:22
*/

use App\DebtBuy;
use App\Message;
use App\User;
use App\FrontUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Zhuzhichao\IpLocationZh\Ip;
use Illuminate\Support\Facades\Validator;


class UserAccountController extends Controller{

    private $uid;

    public function __construct()
    {
        $this->uid = Auth::user()->front_uid;
        date_default_timezone_set('PRC');
    }

    /*
     * 用户个人信息展示
     * */
    public function userInfo(){
        $uid =$this->uid;

        $userName = Auth::user()->real_name;

        $mobile = Auth::user()->mobile;

        $user_debt = DebtBuy::where('uid','=',$uid)->get();
        $debt_count = count($user_debt);
        $debt_value = 0;
        foreach($user_debt as $debt){
            $debt_value += $debt->total_buy;
        }

        $now = date('m',time());
        $user_debt_now = DebtBuy::where('uid','=',$uid)
            ->where('buy_month','=',$now)
            ->count();

        $last_login_location = Ip::find(Auth::user()->user->last_login_ip);

        if(is_array($last_login_location)){
            $location = '';
            foreach($last_login_location as $key=>$value){
                if($key+1<count($last_login_location)&&$last_login_location[$key] != $last_login_location[$key+1]){
                    $location.=$value;
                }
                continue;
            }
        }else{
            $location = $last_login_location;
        }

        $userData = array(
            'phoneNumber'=>$mobile,
            'userName'=>$userName,
            'lastDate'=>date('Y-m-d H:i:s',Auth::user()->user->last_login_time),
            'location'=>$location,
            'hasVote'=>$debt_value,
            'voteNumberHistory'=>$debt_count,
            'voteNumbers'=>$user_debt_now

        );

        echo json_encode(array(
            'status'=>200,
            'msg'=>'ok',
            'data'=>$userData
        ));

        exit();
    }


    /*
     * 用户邮箱信息获取
     **/
    public function emailGet(){

        $email = FrontUser::find($this->uid)->email;
        if($email == ''){
            $email = 0;
        }

        echo json_encode(array(
            'status'=>200,
            'msg'=>'ok',
            'data'=>$email
        ));

        exit();
    }


    /*
     * 用户邮箱信息设置
     **/
    public function emailSet(Request $request){

        $email = $request->input('email');
        if($email == ''){
            $this->throwERROE(501,'email数据不得为空');
        }

        //邮箱格式验证
        $validator = Validator::make(
            array('email'=>$email),
            array('email'=>'email')
        );
        if($validator->fails()){
            $this->throwERROE(500,'email格式错误');
        }

        $userData = FrontUser::Find($this->uid);

        $userData->email = $email;
        if($userData->save()){
            echo json_encode(array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>''
            ));
        }else{
            $this->throwERROE(503,'save error');
        }
    }


    /*
     * 用户反馈添加
     **/
    public function messageSet(Request $request){
        $content = $request->input('message');

        $message = new Message();
        $message->uid = $this->uid;
        $message->content = $content;

        if($message->save()){
            echo json_encode(array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>''
            ));

            exit();
        }else{
            $this->throwERROE(500,'save error');
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