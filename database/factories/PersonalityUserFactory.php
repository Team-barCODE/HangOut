<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PersonalityUser;
use Faker\Generator as Faker;

$factory->define(App\Models\PersonalityUser::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween(1,100),
        'personality_id' => $faker->numberBetween(1,45),

    ];
});
