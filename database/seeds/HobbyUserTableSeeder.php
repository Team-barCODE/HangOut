<?php

use Illuminate\Database\Seeder;
use App\Models\HobbyUser;
use Faker\Generator as Faker;


class HobbyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\HobbyUser::class, 20)->create();
    }
}
