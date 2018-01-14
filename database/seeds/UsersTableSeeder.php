<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'email' => 'admin@by.com',
                'password' => bcrypt('admin'),
                'remember_token' => str_random(10)
            ],
            [
                'email' => 'demo@by.com',
                'password' => bcrypt('demo'),
                'remember_token' => str_random(10)
            ]
        ]);

        factory(App\Models\User::class, 50)->create();
    }
}
