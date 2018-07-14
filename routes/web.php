<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => ['login','role']], function () {
        //　护士视图
        Route::get('/nurse', function () {
            return view('app');
        });

        //　护士视图
        Route::get('/doctor', function () {
            return view('doctor');
        });


        Route::post('/nurse/guahao', 'AppController@guaHao');
        Route::post('/dean/drug', 'AppController@addDrug');
        Route::get('/dean/copyDB', 'AppController@copyDB');


        //　院长视图
        Route::get('/dean', function () {
            return view('dean');
        });
});

//　登录界面视图
Route::get('/login', function () {
    return view('login');
});

Route::get('/nurse/PatientInfo', 'AppController@PatientInfo');


//　没有权限视图
Route::get('/stop', function () {
    return view('stop');
});


//　获取用户名
Route::get('/username', 'AppController@getUsername');

//　用户登录
Route::post('/login/verify/', 'AppController@login');

//　用户登出
Route::get('/logout', 'AppController@logout');



// ================================= 以下是面向用户的路由

//　登录界面视图
Route::get('/', function () {
    return view('qa');
});


//　登录界面视图
Route::get('/app', function () {
    return view('qa');
});

