<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/4/3 下午7:31
*/

//use App\User;
use App\FrontUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Auth;

class UserAccessController extends Controller
{

    /*
     * 用户注册页面（激活其账号）
     **/
    public function registerPage()
    {

        echo "you have arrived the register page!";
    }


    /*
     * 用户登录页面
     **/
    public function loginPage(){

        echo "you have arrived the login page!";
    }


    /*
     * 用户注册操作(API)
     **/
    public function register(Request $request)
    {
        //获取用户输入数据
        $mobile = $request->input('phoneNumber');
        $password = $request->input('password');
        if($mobile == '' || $password == ''){
            $this->throwERROE(501,'手机号或密码不得为空');
        }

        $userCheck = $this->userCheck($mobile);

        if($userCheck){
            $userCheck->user->password = Hash::make($password);
            $userCheck->user->last_login_ip = $this->getIP();
            $userCheck->user->last_login_time = time();
            $userCheck->user->lock = 0;
            if($userCheck->user->save()){
                echo json_encode(
                    array(
                        'status'=>200,
                        'msg'=>'ok',
                        'data'=>'/'
                    )
                );
            }

        }else{
            $this->throwERROE(500,'该手机号未受到本平台邀请');
        }


    }


    /*
     * 用户登录操作(API)
     **/
    public function login(Request $request){
        $mobile = $request->input('phoneNumber');
        $password = $request->input('password');
        if($mobile == '' || $password == ''){
            $this->throwERROE(501,'手机号或密码不得为空');
        }

        $userCheck = $this->userCheck($mobile);
        if(!$userCheck){
            $this->throwERROE(500,'该手机号未注册');
        }


        if(!Hash::check($password,$userCheck->user->password)){
            $this->throwERROE(502,'密码验证失败');
        }


        Auth::login($userCheck,false);


        echo json_encode(
            array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>'/'
            )
        );

        return redirect()->intended('list');

    }



    /*
    * 用户退出操作(API)
    **/
    public function logout(){
        Auth::logout();

        echo json_encode(
            array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>'/'
            )
        );
    }


    /*
     * 用户信息确认
     **/
    private function userCheck($mobile){
        $userData = FrontUser::where('mobile','=',$mobile)->first();
        if(empty($userData)){
            return false;
        }else{
            return $userData;
        }
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