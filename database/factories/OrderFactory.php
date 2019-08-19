<?php

use Faker\Generator as Faker;

$factory->define(\App\Order::class, function (Faker $faker) {
    return [
        'owner_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'total_words' => 300,
        'status' => config('orders-status.payed'),
        'delivery_date' => \Carbon\Carbon::createFromTime('12', '0', '0', 'Asia/Tehran')->addWeek()->addDay(),
        'orders_count' => 4,
        'price' => $faker->numberBetween(0, 10000000)
    ];
});
