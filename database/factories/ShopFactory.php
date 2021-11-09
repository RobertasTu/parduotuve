<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->paragraph(2),
        'email' => $faker->email(),
        'phone' => $faker->e164PhoneNumber(),
        'country' => $faker->country(),

    ];
});
