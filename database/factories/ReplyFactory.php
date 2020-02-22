<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'ticket_id' => factory(\App\Ticket::class),
        'owner_id' => factory(\App\User::class),
        'body' => 'Lorem ipsum'
    ];
});
