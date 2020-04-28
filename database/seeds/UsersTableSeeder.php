<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => '訓志',
            'email' => 'user1@test.com',
            'sex' => '0',
            'self_introduction' => '訓志です',
            'img_name' => 'sample001.jpg',
            'password' => Hash::make('111111'),
            ],
            ['name' => 'チョッパー',
            'email' => 'user2@test.com',
            'sex' => '1',
            'self_introduction' => 'チョッパーです',
            'img_name' => 'sample002.jpg',
            'password' => Hash::make('111111'),
            ],
            ['name' => 'ドンキング',
            'email' => 'user3@test.com',
            'sex' => '0',
            'self_introduction' => 'ドンキングですです',
            'img_name' => 'sample003.jpg',
            'password' => Hash::make('111111'),
            ],
            ['name' => '貴花田親方',
            'email' => 'user4@test.com',
            'sex' => '0',
            'self_introduction' => '貴花田親方です',
            'img_name' => 'sample004.jpg',
            'password' => Hash::make('111111'),
            ],
        ]);
    }
}
