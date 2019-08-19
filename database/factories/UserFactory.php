<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $name = '';

    do {
        $name = $faker->name;
    } while(strlen($name) < 4 );

    do {
        $username = $faker->unique()->word;
    } while(strlen($username) < 4 );

    return [
        'name' => $name,
        'username' => $username,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone' => '09123456789',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'confirmed' => false,
        'remember_token' => str_random(10),
    ];
});
