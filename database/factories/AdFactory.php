<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Domains\Ads\Ad::class, function (Faker\Generator $faker) {
    return [
        'slug' => str_slug($faker->sentence(6, 3)),
        'title' => $faker->sentence(6, 3),
        'description' => $faker->paragraph,
        'content' => $faker->text,
        'price' => $faker->randomFloat(2, 1, 1000),
        'user_id' => function () {
            return factory(\App\Domains\Users\User::class)->create()->id;
        },
        'begin' => $faker->date(),
        'end' => $faker->date(),
        'status' => $faker->randomDigit
    ];
});
