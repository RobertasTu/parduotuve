<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->paragraph(4),
        'shop_id' => rand(1, 10),
    ];
});
