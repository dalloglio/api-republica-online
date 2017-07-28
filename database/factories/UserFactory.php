<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\User\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'birthday' => $faker->date(),
        'gender' => $faker->randomElement(\App\Domains\User\User::genders()),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = 'secret',
        'status' => mt_rand(0, 5),
        'remember_token' => str_random(10),
    ];
});
