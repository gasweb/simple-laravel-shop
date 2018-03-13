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

$factory->define(App\Brand::class, function (Faker $faker) {
    return [
        'alias' => $faker->slug,
        'title' => $faker->randomElement(['Brand 1', 'Brand 2', 'Brand 3'])
    ];
});
