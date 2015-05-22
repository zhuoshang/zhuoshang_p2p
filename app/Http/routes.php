<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', array('before' => 'indexCheck'));//用户中心首页


#zsmobile 页面

Route::get('zsmobile/index',array('before' => 'loginCheck','uses'=>'DebtController@debtIndex'));

Route::get('zsmobile/login','UserAccessController@loginPage');

Route::get('zsmobile/register','UserAccessController@registerPage');

Route::get('zsmobile/login','UserAccessController@loginPage');//登录页面




#zsmobile API



#公共API
Route::post('register','UserAccessController@register');//注册接口

Route::post('login','UserAccessController@login');//登录接口

Route::get('list', array('before' => 'loginCheck','uses'=>'DebtController@debtList'));//当月资产列表接口

Route::get('monthlist',array('before' => 'loginCheck','uses'=>'DebtController@monthDebtList'));//按月查询资产列表接口

Route::get('debtTable',array('before'=>'loginCheck','uses'=>'DebtController@debtTable'));//正在发布的基金列表

Route::get('debtTypeList',array('before'=>'loginCheck','uses'=>'DebtController@DebtTypeList'));//基金类型列表

Route::get('userinfo',array('before'=>'loginCheck','uses'=>'UserAccountController@userInfo'));//用户信息获取接口

Route::get('logout',array('before' => 'loginCheck','uses'=>'UserAccessController@logout'));//用户退出接口

Route::get('debtContent',array('before'=>'loginCheck','uses'=>'DebtController@debtContent'));//基金详情接口

Route::get('email',array('before'=>'loginCheck','uses'=>'UserAccountController@emailGet'));//获取用户邮箱接口

Route::post('email',array('before'=>'loginCheck','uses'=>'UserAccountController@emailSet'));//用户邮箱设置&修改接口

Route::post('message',array('before'=>'loginCheck','uses'=>'UserAccountController@messageSet'));//用户反馈接口

Route::post('withDraw',array('before'=>'loginCheck','uses'=>'UserAccountController@withdrawDeposit'));//提现接口

Route::post('recharge',array('before'=>'loginCheck','uses'=>'UserAccountController@recharge'));//充值接口

Route::post('debtOrder',array('before' => 'loginCheck','uses'=>'DebtController@orderSet'));//基金预约接口

Route::get('activityList',array('before'=>'loginCheck','uses'=>'ActivityController@activityList'));//贵宾优享列表

Route::get('charityList',array('before'=>'loginCheck','uses'=>'ActivityController@charityList'));//爱心捐赠列表

Route::get('activityContent',array('before'=>'loginCheck','uses'=>'ActivityController@activityContent'));//贵宾优享详情

Route::get('charityContent',array('before'=>'loginCheck','uses'=>'ActivityController@charityContent'));//爱心捐赠详情

Route::post('acOrder',array('before'=>'loginCheck','uses'=>'ActivityController@acOrder'));//爱心捐赠及贵宾优享预约接口

Route::get('acDetail',array('before'=>'loginCheck','uses'=>'ActivityController@acDetail'));//爱心捐赠及贵宾优享明细

Route::post('smsSent','SmsController@smsSent');//短信发送接口

Route::get('introduce',array('before'=>'loginCheck','uses'=>'SiteController@introduce'));//获取公司介绍

Route::get('agreement',array('before'=>'loginCheck','uses'=>'SiteController@agreement'));//获取用户协议






#登录验证
Route::filter('loginCheck', function()
{

    if (!\Auth::check())
    {
        return Redirect::to('zsmobile/login');

    }
});

#根目录跳转
Route::filter('indexCheck', function()
{
    if (!\Auth::check())
    {
        return Redirect::to('zsmobile/login');

    }else{
        return Redirect::to('zsmobile/index');
    }
});