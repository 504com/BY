<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantsPaymentsModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants_payments_modes')->insert([
            [
                'restaurant_id' => 1,
                'payment_mode_id' => 1
            ],
            [
                'restaurant_id' => 1,
                'payment_mode_id' => 2
            ],
            [
                'restaurant_id' => 1,
                'payment_mode_id' => 3
            ],
        ]);
    }
}
