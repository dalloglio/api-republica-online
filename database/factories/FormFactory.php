<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Form\Form::class, function (Faker\Generator $faker) {
    $title = $faker->words(3, true);
    return [
        'slug' => str_slug($title),
        'title' => $title,
        'description' => $faker->words(6, true),
        'type' => $faker->randomKey(\App\Domains\Form\Form::types())
    ];
});
