<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    dd('Api República Online');
});

Route::group(['middleware' => ['api']], function () {

    $exceptRoutes = ['create', 'edit'];

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('ads', 'AdController', ['except' => $exceptRoutes]);
    Route::resource('users', 'UserController', ['except' => $exceptRoutes]);
});

