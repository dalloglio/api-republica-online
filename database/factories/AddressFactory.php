<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Domains\Addresses\Address::class, function (Faker\Generator $faker) {
    return [
        'zip_code' => $faker->numerify('########'),
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'sub_address' => $faker->secondaryAddress,
        'neighborhood' => $faker->cityPrefix,
        'country' => $faker->country,
        'state' => $faker->stateAbbr,
        'city' => $faker->city,
    ];
});
