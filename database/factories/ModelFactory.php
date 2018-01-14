<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function(Faker\Generator $faker)
{
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Restaurant::class, function(Faker\Generator $faker)
{
    $company = $faker->unique()->company;
    $slug = str_slug($company);

    return [
        'name' => $company,
        'slug' => $slug,
        'email' => $faker->email,
        'password' => Hash::make('test'),
        'flash' => $faker->sentence,
        'description' => $faker->paragraph,
        'latitude' => number_format(mt_rand(430, 499) / 10, 2),
        'longitude' => number_format(mt_rand(7, 83) / 10, 2),
        'address' => $faker->address,
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
		'phone' => '0000000000',
        'picture' => 'restaurant1.jpg'
    ];
});
