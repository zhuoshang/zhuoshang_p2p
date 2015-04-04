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
Route::get('/', array('before' => 'loginCheck', 'uses' => 'WelcomeController@index'));//用户中心首页

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('zsmobile',array('before' => 'loginCheck','DebtController@debtIndex'));

Route::get('list', array('before' => 'loginCheck','uses'=>'DebtController@debtList'));

Route::get('monthlist',array('before' => 'loginCheck','DebtController@monthDebtList'));

Route::get('register','UserAccessController@registerPage');

Route::post('register','UserAccessController@register');

Route::get('login','UserAccessController@loginPage');

Route::post('login','UserAccessController@login');

Route::get('logout',array('before' => 'loginCheck','uses'=>'UserAccessController@logout'));

#登录验证
Route::filter('loginCheck', function()
{
    if (!\Auth::check())
    {
        return Redirect::to('login');

    }
});