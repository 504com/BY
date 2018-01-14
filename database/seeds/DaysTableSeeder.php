<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            [
                'name' => 'monday'
            ],
            [
                'name' => 'tuesday'
            ],
            [
                'name' => 'wednesday'
            ],
            [
                'name' => 'thursday'
            ],
            [
                'name' => 'friday'
            ],
            [
                'name' => 'saturday'
            ],
            [
                'name' => 'sunday'
            ]
        ]);
    }
}
