<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Ad\Ad::class, function (Faker\Generator $faker) {
    return [
        'slug' => str_slug($faker->sentence(6)),
        'title' => $faker->sentence(6),
        'description' => $faker->sentence(6),
        'content' => $faker->text,
        'price' => $faker->randomFloat(2, 1, 1000),
        'category_id' => function () {
            return factory(\App\Domains\Category\Category::class)->create()->id;
        },
        'user_id' => function () {
            return factory(\App\Domains\User\User::class)->create()->id;
        },
        'begin' => $faker->datetime(),
        'end' => $faker->datetime(),
        'status' => $faker->randomDigit
    ];
});
