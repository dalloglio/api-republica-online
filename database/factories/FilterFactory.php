<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Filter\Filter::class, function (Faker\Generator $faker) {
    $title = $faker->words(3, true);
    return [
        'slug' => str_slug($title),
        'title' => $title,
        'description' => $faker->sentence(3),
        'type' => $faker->randomKey(\App\Domains\Filter\Filter::types()),
        'values' => $faker->words(3, true)
    ];
});
