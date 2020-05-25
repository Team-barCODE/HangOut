<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\JobUser;
use Faker\Generator as Faker;

$factory->define(App\Models\JobUser::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween(1,100),
        'job_id' => $faker->numberBetween(1,51),
    ];
});
