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

//Route::get('/', 'WelcomeController@index');
Route::get('/', array('before' => 'indexCheck'));//用户中心首页

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

#zsmobile 页面

Route::get('zsmobile/index',array('before' => 'loginCheck','uses'=>'DebtController@debtIndex'));

Route::get('zsmobile/login','UserAccessController@loginPage');

Route::get('zsmobile/register','UserAccessController@registerPage');

Route::post('login','UserAccessController@login');


#zsmobile API



#公共API
Route::post('register','UserAccessController@register');

Route::get('zsmobile/login','UserAccessController@loginPage');

Route::get('list', array('before' => 'loginCheck','uses'=>'DebtController@debtList'));

Route::get('monthlist',array('before' => 'loginCheck','uses'=>'DebtController@monthDebtList'));

Route::get('debtTable',array('before'=>'loginCheck','uses'=>'DebtController@debtTable'));

Route::get('debtTypeList',array('before'=>'loginCheck','uses'=>'DebtController@DebtTypeList'));

Route::get('userinfo',array('before'=>'loginCheck','uses'=>'UserAccountController@userInfo'));

Route::get('logout',array('before' => 'loginCheck','uses'=>'UserAccessController@logout'));

Route::get('debtContent',array('before'=>'loginCheck','uses'=>'DebtController@debtContent'));

Route::get('email',array('before'=>'loginCheck','uses'=>'UserAccountController@emailGet'));

Route::post('email',array('before'=>'loginCheck','uses'=>'UserAccountController@emailSet'));

Route::post('message',array('before'=>'loginCheck','uses'=>'UserAccountController@messageSet'));




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