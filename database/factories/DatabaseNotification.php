<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\Illuminate\Notifications\DatabaseNotification::class, function (Faker $faker) {
    return [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'type' => 'App\Notifications\TicketCreatedNotification',
        'notifiable_type' => 'App\User',
        'notifiable_id' => function ()  {
            return auth()->user() ? auth()->user()->id : factory(\App\User::class)->create()->id;
        },
        'data' => ['foo' => 'bar']
    ];
});
