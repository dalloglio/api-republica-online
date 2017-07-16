<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Banner\Banner::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->words(3, true),
        'description' => $faker->words(6, true),
        'link' => $faker->url,
        'size' => $faker->randomKey(\App\Domains\Banner\Banner::sizes())
    ];
});