<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            [
                'name' => 'Los Pollos Hermanos',
                'slug' => str_slug('Los Pollos Hermanos'),
                'email' => 'los@pollos.hermanos',
                'password' => Hash::make('test'),
                'flash' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
                'description' => 'Quibusdam incidunt amet libero.
                Quia odio dicta sapiente.
                Quis beatae iste perferendis aliquam distinctio necessitatibus natus corrupti.
                Sit corrupti libero dolore qui aut consequatur dolore.',
                'latitude' => 48.5822713,
                'longitude' => 7.7733075,
                'address' => '74 Avenue de le forêt noire',
                'city' => 'Strasbourg',
                'zipcode' => '67000',
				'phone' => '0000000000',
                'picture' => 'restaurant1.jpg',
				'capacity' => 30
            ],
            [
                'name' => 'Big Kahuna Burger',
                'slug' => str_slug('Big Kahuna Burger'),
                'email' => 'test@test.fr',
                'password' => Hash::make('test'),
                'flash' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'description' => 'Quibusdam incidunt amet libero.
                Quia odio dicta sapiente.
                Quis beatae iste perferendis aliquam distinctio necessitatibus natus corrupti.
                Sit corrupti libero dolore qui aut consequatur dolore.',
                'latitude' => 48.8928553,
                'longitude' => 2.3344098,
                'address' => '10 rue Vauvenargues',
                'city' => 'Paris',
                'zipcode' => '75018',
				'phone' => '0000000000',
                'picture' => 'restaurant1.jpg',
				'capacity' => 30
            ],
            [
                'name' => 'Cluckin Bell',
                'slug' => str_slug('Cluckin Bell'),
                'email' => 'cluckin@bell.fr',
                'password' => Hash::make('test'),
                'flash' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'description' => 'Quibusdam incidunt amet libero.
                Quia odio dicta sapiente.
                Quis beatae iste perferendis aliquam distinctio necessitatibus natus corrupti.
                Sit corrupti libero dolore qui aut consequatur dolore.',
                'latitude' => 48.5824018,
                'longitude' => 7.735491,
                'address' => '50 rue du faubourg national',
                'city' => 'Strasbourg',
                'zipcode' => '67000',
				'phone' => '0000000000',
                'picture' => 'restaurant1.jpg',
				'capacity' => 30
            ]
        ]);

        factory(App\Models\Restaurant::class, 500)->create();
    }
}
