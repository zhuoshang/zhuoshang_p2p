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
Route::get('zsmobile/logout',array('before' => 'loginCheck','uses'=>'UserAccessController@logout'));


#公共API
Route::post('register','UserAccessController@register');

Route::get('zsmobile/login','UserAccessController@loginPage');

Route::get('list', array('before' => 'loginCheck','uses'=>'DebtController@debtList'));

Route::get('monthlist',array('before' => 'loginCheck','uses'=>'DebtController@monthDebtList'));

Route::get('debtTable',array('before'=>'loginCheck','uses'=>'DebtController@debtTable'));



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