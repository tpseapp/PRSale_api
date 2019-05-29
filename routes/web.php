<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => '/do'], function ($router) {
    $router->get('/', function () use ($router) {
        return "<h1>do It work</h1>";
    });

    $router->get('/test', 'Auth\LoginController@getMemberToken');


    $router->post('/login', 'Auth\LoginController@login');
});





//หลังจาก login ให้ใช้ 'middleware' => 'jwt.auth' เพื่อเช๊คค่า header('Authorization'); ----------
$router->group(['prefix' => '/member', 'middleware' => 'jwt.auth'], function ($router) {
    $router->get('/', function () use ($router) {
        return "<h1>member It work</h1>";
    });

    $router->get('/test', 'Auth\LoginController@getMember');
    $router->get('/decode', 'Auth\DecodeController@tokenDecode');

    $router->post('/logout', 'Auth\LoginController@Logout');

});
//-----------------------------------------------------------------------------------------




$router->group(['prefix' => '/CheckIn'], function ($router) {
    $router->get('/', function () use ($router) {
        return "<h1>tester It work</h1>";
    });

    $router->post('/record', 'TimeRecordController@getTimeRecord');
    $router->post('/in', 'TimeRecordController@SaveIn_TimeWork');
    $router->post('/out', 'TimeRecordController@SaveOut_TimeWork');

});


$router->group(['prefix' => '/cust'], function ($router) {
    $router->get('/', function () use ($router) {
        return "<h1>cust It work</h1>";
    });

    $router->get('/all', 'CustomerController@all');
    $router->post('/add', 'CustomerController@add');
    $router->post('/edit', 'CustomerController@edit');

});

