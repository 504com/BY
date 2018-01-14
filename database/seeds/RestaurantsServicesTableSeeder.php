<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantsServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants_services')->insert([
            [
                'restaurant_id' => 1,
                'service_id' => 1
            ],
            [
                'restaurant_id' => 1,
                'service_id' => 2
            ],
            [
                'restaurant_id' => 1,
                'service_id' => 3
            ]
        ]);
    }
}
