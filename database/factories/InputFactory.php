<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Filter\Input::class, function (Faker\Generator $faker) {
    $input = $faker->words(1, true);
    return [
        'key' => str_slug($input),
        'value' => $input
    ];
});
