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
    echo '<h2>Api República Online</h2>';
});

Route::group(['middleware' => ['api']], function () {

    $exceptRoutes = ['create', 'edit'];

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('addresses', 'AddressController', ['except' => $exceptRoutes]);
    Route::resource('ads', 'AdController', ['except' => $exceptRoutes]);
    Route::resource('ads.addresses', 'AdAddressController', ['except' => $exceptRoutes]);
    Route::resource('ads.photos', 'AdPhotoController', ['except' => $exceptRoutes]);
    Route::resource('contacts', 'ContactController', ['except' => $exceptRoutes]);
    Route::resource('categories', 'CategoryController', ['except' => $exceptRoutes]);
    Route::resource('files', 'FileController', ['except' => $exceptRoutes]);
    Route::resource('filters', 'FilterController', ['except' => $exceptRoutes]);
    Route::resource('partners', 'PartnerController', ['except' => $exceptRoutes]);
    Route::resource('photos', 'PhotoController', ['except' => $exceptRoutes]);
    Route::resource('users', 'UserController', ['except' => $exceptRoutes]);
    Route::resource('videos', 'VideoController', ['except' => $exceptRoutes]);
});
