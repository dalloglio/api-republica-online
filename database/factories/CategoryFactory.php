<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Category\Category::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(3);
    return [
        'slug' => str_slug($title),
        'title' => $title,
        'description' => $faker->sentence(6),
        'status' => $faker->randomDigit,
    ];
});
