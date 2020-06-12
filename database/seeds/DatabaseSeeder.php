<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(HobbiesTableSeeder::class);
        $this->call(PersonalitiesTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(HobbyUserTableSeeder::class);
        $this->call(JobUserTableSeeder::class);
        $this->call(PersonalityUserTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
    }
}
