<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'message' => 'Hello Hamed',
        'rate' => 4
    ];
});
