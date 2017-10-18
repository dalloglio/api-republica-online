<?php
Route::get('/', function () {
    return redirect('/v1');
});

Route::get('photo/{id}', 'PhotoController@photo')->middleware('api');

Route::get('estados.json', 'JsonController@estados')->middleware('api');
Route::get('cidades.json', 'JsonController@cidades')->middleware('api');
