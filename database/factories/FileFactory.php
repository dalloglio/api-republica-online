<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\File\File::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(6),
        'file' => $faker->imageUrl(),
        'name' => $faker->name,
        'type' => $faker->mimeType,
        'size' => 100,
        'url' => $faker->imageUrl()
    ];
});