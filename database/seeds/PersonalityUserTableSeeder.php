<?php

use Illuminate\Database\Seeder;

class PersonalityUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\PersonalityUser::class, 20)->create();
    }
}
