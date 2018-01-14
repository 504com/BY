<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Menu hit burger',
                'description' => '1 hit burger, 1 frites, 1 boisson 33 cl, 1 dessert sauf panini et cheese cake',
                'price' => 14,
                'category_id' => 1
            ],
            [
                'name' => 'Menu hit duo burger',
                'description' => '2 hit burgers, 2 frites, 2 boissons 33 cl, 2 desserts sauf panini et cheese cake',
                'price' => 25,
                'category_id' => 1
            ],
            [
                'name' => 'Menu du soir',
                'description' => '1 hit burger au choix, frites maison et 1 boisson 33 cl au choix',
                'price' => 12.80,
                'category_id' => 2
            ],
            [
                'name' => 'Onion rings x12',
                'description' => null,
                'price' => 6.70,
                'category_id' => 3
            ],
            [
                'name' => 'Chicken wings x10',
                'description' => null,
                'price' => 7.70,
                'category_id' => 3
            ],
            [
                'name' => 'Nuggets x12',
                'description' => null,
                'price' => 6.70,
                'category_id' => 3
            ],
            [
                'name' => 'Frites',
                'description' => null,
                'price' => 2.70,
                'category_id' => 3
            ],
            [
                'name' => 'Jalapenos x6',
                'description' => null,
                'price' => 6.70,
                'category_id' => 3
            ],
            [
                'name' => 'Spicy hit burger',
                'description' => 'Steak de bœuf 150g fait maison, oignons, poivrons frits, spicy sauce, cheddar, salade, tomates, spécial sauce et cheddar affiné',
                'price' => 9.50,
                'category_id' => 4
            ],
            [
                'name' => 'Hit burger',
                'description' => 'Steak de bœuf 150g fait maison, oignons frits, bacon de dinde grillé, cheddar, salade, tomates, spécial sauce et cheddar affiné',
                'price' => 9.50,
                'category_id' => 4
            ],
            [
                'name' => 'Crazy hit burger',
                'description' => 'Steak de bœuf 150g fait maison, oignons frits, bacon de dinde grillé, cheddar, salade, tomates, spécial sauce et cheddar affiné',
                'price' => 9.50,
                'category_id' => 4
            ],
        ]);
    }
}
