<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'alias' => $faker->slug,
        'title' => $faker->sentence,
        'price' => $faker->randomFloat(2, 100, 50000),
        'preview_description' => $faker->text(500),
        'category_id' => $faker->numberBetween(1,100),
        'brand_id' => $faker->numberBetween(1,3),
        'in_stock' => $faker->numberBetween(0,1),
        'enable' => $faker->numberBetween(0,1),
    ];
});
