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

Route::get('teste', function () {

});

Route::group(['middleware' => ['auth:api']], function () {

    $exceptRoutes = ['create', 'edit'];

    /**
     * Rotas para recursos específicos do usuário autenticado
     */
    Route::prefix('user')->group(function () {
        # User
        Route::get('/', 'User\UserController@index');
        Route::put('/', 'User\UserController@update');
        Route::patch('/password', 'User\UserController@updatePassword');
        Route::post('/photo', 'User\UserController@updatePhoto');
        # Ads

        Route::get('ads/contacts', 'User\AdContactController@index');
        Route::get('ads/{ad}/contacts/{contact}', 'User\AdContactController@show');
        Route::delete('ads/{ad}/contacts/{contact}', 'User\AdContactController@destroy');

        Route::get('ads', 'User\AdController@index');
        Route::get('ads/{ad}', 'User\AdController@show');
        Route::post('ads', 'User\AdController@store');
        Route::put('ads/{ad}', 'User\AdController@update');
        Route::post('ads/{ad}/photos', 'User\AdPhotoController@store');
        Route::post('ads/{ad}/photos/{photo}/favorite', 'User\AdPhotoController@favorite');
        Route::delete('ads/{ad_id}', 'User\AdController@destroy');
        # Users
        Route::get('favorites', 'User\UserFavoriteController@index');
        Route::post('favorites', 'User\UserFavoriteController@store');
        Route::delete('favorites/{id}', 'User\UserFavoriteController@destroy');
    });

    /**
     * Rotas gerais da API
     */
    Route::resource('addresses', 'AddressController', ['except' => $exceptRoutes]);
    Route::resource('ads', 'AdController', ['except' => $exceptRoutes]);
    Route::resource('ads.addresses', 'AdAddressController', ['except' => $exceptRoutes]);
    Route::resource('ads.contacts', 'AdContactController', ['except' => $exceptRoutes]);
    Route::resource('ads.photos', 'AdPhotoController', ['except' => $exceptRoutes]);
    Route::resource('banners', 'BannerController', ['except' => $exceptRoutes]);
    Route::resource('banners.photos', 'BannerPhotoController', ['except' => $exceptRoutes]);
    Route::resource('contacts', 'ContactController', ['except' => $exceptRoutes]);
    Route::resource('categories', 'CategoryController', ['except' => $exceptRoutes]);
    Route::resource('files', 'FileController', ['except' => $exceptRoutes]);
    Route::resource('filters', 'FilterController', ['except' => $exceptRoutes]);
    Route::resource('forms', 'FormController', ['except' => $exceptRoutes]);
    Route::resource('forms.contacts', 'FormContactController', ['except' => $exceptRoutes]);
    Route::resource('partners', 'PartnerController', ['except' => $exceptRoutes]);
    Route::resource('partners.photos', 'PartnerPhotoController', ['except' => $exceptRoutes]);
    Route::resource('photos', 'PhotoController', ['except' => $exceptRoutes]);
    Route::resource('users', 'UserController', ['except' => $exceptRoutes]);
    Route::resource('users.photos', 'UserPhotoController', ['except' => $exceptRoutes]);
    Route::resource('users.favorites', 'UserFavoriteController', ['except' => $exceptRoutes]);
    Route::resource('videos', 'VideoController', ['except' => $exceptRoutes]);
});

Route::post('users/facebook', 'UserController@facebook');
Route::post('users/register', 'UserController@register');
Route::post('password/email', 'ForgotPasswordController@forgot')->name('password.email');
Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');

/**
 * Rotas para o site
 */
Route::prefix('site')->group(function () {
    # Ads
    Route::get('ads', 'Site\AdController@index');
    Route::get('ads/latest', 'Site\AdController@latest');
    Route::get('ads/prices', 'Site\AdController@prices');
    Route::get('ads/categories', 'Site\AdController@categories');
    Route::get('ads/states', 'Site\AdController@states');
    Route::get('ads/states/{ID}/cities', 'Site\AdController@states_cities');
    Route::get('ads/{ad}', 'Site\AdController@show');
    Route::post('ads/{ad}/contacts', 'Site\AdContactController@store');
    # Banners
    Route::get('banners', 'Site\BannerController@index');
    # Categories
    Route::get('categories', 'Site\CategoryController@index');
    Route::get('categories/{category}', 'Site\CategoryController@show');
     # Forms
    Route::post('forms/{form}/contacts', 'Site\FormContactController@store');
     # Partners
    Route::get('partners', 'Site\PartnerController@index');
});
