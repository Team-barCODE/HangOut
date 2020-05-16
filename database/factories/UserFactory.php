<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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

$factory->define(App\Models\User::class, function (Faker $faker) {

    $sex = [0, 1, 2];
    $images = [
        'man1.jpg', 'man2.jpg', 'man3.jpg', 'man4.jpg', 'man5.jpg',
        'woman1.png', 'woman2.jpeg', 'woman3.jpeg', 'woman4.jpeg', 'woman5.jpg',
    ];

    return [
        'name' => $faker->name(),
        'sex' => $faker->randomElement($sex),
        'self_introduction' => $faker->realText(),
        'img_name1' => $faker->randomElement($images),
        // 'age' => $faker->randomElement($age),
        'birth_date' => $faker->dateTime(),
        'prefecture' => $faker->prefecture,
        'email' => $faker->unique()->email(),
        'password' => bcrypt('111111'),
        'email_verified_at' => $faker->dateTime(),
        'body_height' => $faker->randomFloat(1,140.0,200.0),
        'body_figure' => $faker->numberBetween(0,2),
        'education' => $faker->numberBetween(0,5),
        'smoke' => $faker->numberBetween(0,1),
        'alcohol' => $faker->numberBetween(0,1),
        'income' => $faker->numberBetween(200,999),
        'housemate' => $faker->numberBetween(0,1),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
