<?php namespace App\Http\Controllers;
/*
**Author:tianling
**createTime:15/5/2 上午11:43
*/

use App\Agreement;
use App\Introduce;

class SiteController extends Controller{

    /*
     * 获取公司介绍
     **/
    public function introduce(){
        $intro = Introduce::where('use','=',1)->first();
        if($intro == ''){
            $introContent = '';
        }else{
            $introContent = $intro->content;
        }

        echo json_encode(
            array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>$introContent
            )
        );

        exit();

    }


    /*
     * 获取用户协议
     **/
    public function agreement(){
        $agree = Agreement::where('use','=',1)->first();
        if($agree == ''){
            $agreeContent = '';
        }else{
            $agreeContent = $agree->content;
        }

        echo json_encode(
            array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>$agreeContent
            )
        );

        exit();
    }
}

