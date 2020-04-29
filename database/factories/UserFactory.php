<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    // return [
    //     'name' => $faker->name,
    //     'email' => $faker->unique()->safeEmail,
    //     'email_verified_at' => now(),
    //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    //     'remember_token' => Str::random(10),
    // ];

    $sex = [0, 1];
    $images = [
        'man1.jpg', 'man2.jpg', 'man3.jpg', 'man4.jpg', 'man5.jpg',
        'woman1.png', 'woman2.jpeg', 'woman3.jpeg', 'woman4.jpeg', 'woman5.jpg',
    ];

    return [
        'name' => $faker->name(),
        'sex' => $faker->randomElement($sex),
        'self_introduction' => $faker->realText(),
        'img_name' => $faker->randomElement($images),
        // 'age' => $faker->randomElement($age),
        'prefecture' => $faker->prefecture,
        'email' => $faker->unique()->email(),
        'password' => bcrypt('111111'),
        'email_verified_at' => $faker->dateTime(),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
