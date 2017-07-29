<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Domains\Contact\Contact::class, function (Faker\Generator $faker) {
    $cellphone = $faker->areaCode() . $faker->cellphone(false, true);
    return [
        'name' => $faker->name,
        'email' => $faker->freeEmail,
        'phone' => $faker->phoneNumberCleared,
        'cellphone' => $cellphone,
        'whatsapp' => $cellphone,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'role' => $faker->words(1, true),
        'subject' => $faker->words(3, true),
        'message' => $faker->paragraph,
        'about' => $faker->paragraph
    ];
});
