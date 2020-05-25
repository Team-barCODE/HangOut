<?php

use Illuminate\Database\Seeder;

class JobUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\JobUser::class, 10)->create();
    }
}
