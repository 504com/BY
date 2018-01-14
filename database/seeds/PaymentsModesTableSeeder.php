<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments_modes')->insert([
            [
                'name' => 'paypal'
            ],
            [
                'name' => 'credit_card'
            ],
            [
                'name' => 'cash'
            ]
        ]);
    }
}
