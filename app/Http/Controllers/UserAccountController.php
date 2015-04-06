<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/4/5 下午7:22
*/

use App\DebtBuy;
use App\User;
use App\FrontUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Auth;
//require 'vendor/autoload.php'; 
use Zhuzhichao\IpLocationZh\Ip;


class UserAccountController extends Controller{

    public function userInfo(){
        $uid = Auth::user()->front_uid;

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
//        var_dump($last_login_location);
//        die;
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
}