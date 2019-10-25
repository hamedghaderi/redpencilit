<?php

use Faker\Generator as Faker;

$factory->define(App\UserDetail::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'college' => 'Stanford University',
        'field' => 'Software Engineering',
        'degree_id' => factory(\App\CollegeDegree::class),
        'country_id' => factory(\App\Country::class),
        'address' => $faker->address
    ];
});
