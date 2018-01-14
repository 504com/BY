<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Menus',
                'restaurant_id' => 1
            ],
            [
                'name' => 'Formules du soir',
                'restaurant_id' => 1
            ],
            [
                'name' => 'Entrées',
                'restaurant_id' => 1
            ],
            [
                'name' => 'Burgers',
                'restaurant_id' => 1
            ],
            [
                'name' => 'Desserts',
                'restaurant_id' => 1
            ],
            [
                'name' => 'Boissons',
                'restaurant_id' => 1
            ],
        ]);
    }
}
