<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'excerpt' => $faker->paragraph(3),
        'description' => $faker->paragraph(6),
        'price' => $faker->numberBetween(15,1000),
        'image' => $faker->imageUrl(360, 360, 'animals', true, 'dogs', true),
        'category_id' => rand(1, 30)

    ];
});
