<?php

use Faker\Generator as Faker;

$factory->define(\App\OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => function () {
            return factory(\App\Order::class)->create()->id;
        },
        'path' => $faker->name,
        'name' => $faker->name,
        'words' => $faker->numberBetween(0, 20000)
    ];
});
