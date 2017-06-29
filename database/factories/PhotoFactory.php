<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Domains\Photo\Photo::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(6),
        'photo' => $faker->imageUrl(),
        'name' => $faker->name,
        'type' => $faker->mimeType,
        'size' => 100,
        'url' => $faker->imageUrl()
    ];
});
