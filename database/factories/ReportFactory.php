<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Report;
use Faker\Generator as Faker;

$factory->define(App\Models\Report::class, function (Faker $faker) {
    return [
        //
        'to_user_id' => $faker->numberBetween(1,99),
        'from_user_id' => $faker->numberBetween(1,99),
        'report_level' => $faker->numberBetween(0,4),
        'report_detail' => $faker->realText(),
    ];
});
