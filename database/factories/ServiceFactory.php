<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'owner_id'  => function() {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
