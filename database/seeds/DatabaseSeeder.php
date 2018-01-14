<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(RestaurantsTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(ServicesTableSeeder::class);
         $this->call(RestaurantsServicesTableSeeder::class);
         $this->call(PaymentsModesTableSeeder::class);
         $this->call(RestaurantsPaymentsModesTableSeeder::class);
         $this->call(DaysTableSeeder::class);
         $this->call(FrontContentsTableSeeder::class);
		 $this->call(AdminTableSeeder::class);
    }
}
