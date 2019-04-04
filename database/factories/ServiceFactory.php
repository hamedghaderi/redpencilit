<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->numberBetween(50000, 300000),
        'owner_id'  => function() {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
