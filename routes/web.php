<?php
Route::get('/', function () {
    return redirect('/v1');
});

Route::get('teste', function() {

    $guzzle = new GuzzleHttp\Client();

    $response = $guzzle->post('http://localhost.api.republica.online/oauth/token', [
        'form_params' => [
            'grant_type' => 'client_credentials',
            'client_id' => '2',
            'client_secret' => 'lwrRZOG6GsN7ftYjbPLsulcUfC9v9eGNI5ZDXrLL',
            'scope' => '',
        ],
    ]);
    $token = (string) $response->getBody();
    dd(json_decode($token));

});

Route::get('photo/{id}', 'PhotoController@photo')->middleware('api');
