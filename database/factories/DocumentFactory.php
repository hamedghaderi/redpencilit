<?php

use Faker\Generator as Faker;

$factory->define(\App\Document::class, function (Faker $faker) {
    return [
        'path' => $faker->name,
        'owner_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'draft' => $faker->boolean,
        'words' => $faker->numberBetween(0, 1000),
        'recent' => $faker->boolean,
        'code' => uniqid()
    ];
});
