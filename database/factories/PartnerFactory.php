<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Partner\Partner::class, function (Faker\Generator $faker) {
    $title = $faker->words(3, true);
    return [
        'slug' => str_slug($title),
        'title' => $title,
        'description' => $faker->words(6, true),
        'link' => $faker->url
    ];
});