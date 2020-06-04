<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => [
            'fa'  => 'Farsi Resume',
            'en' => 'Resume'
        ],
        'negotiable' => false,
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});

$factory->state(\App\Service::class, '', function (Faker $faker) {
});
