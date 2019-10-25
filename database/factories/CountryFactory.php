<?php

use Faker\Generator as Faker;

$factory->define(App\Country::class, function (Faker $faker) {
    return [
        'name' => json_encode(['fa' => 'هورامان', 'en' => 'Hawraman'])
    ];
});
