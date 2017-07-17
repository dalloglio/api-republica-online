<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Favorite\Favorite::class, function () {
    $ad = factory(\App\Domains\Ad\Ad::class)->create();
    return [
        'ad_id' => $ad->id
    ];
});