<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\HobbyUser;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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


$factory->define(App\Models\HobbyUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,99),
        'hobby_id' => $faker->numberBetween(1,62),
    ];
});
