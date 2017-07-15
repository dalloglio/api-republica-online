<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Contact\Contact::class, function (Faker\Generator $faker) {
    $cellphone = $faker->areaCode() . $faker->cellphone(false, true);
    return [
        'name' => $faker->name,
        'cellphone' => $cellphone,
        'whatsapp' => $cellphone
    ];
});
