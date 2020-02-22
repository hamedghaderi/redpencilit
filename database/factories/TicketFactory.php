<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    \Illuminate\Support\Facades\Storage::fake('ticket');
    
    return [
        'title' => 'My Ticket Title',
        'body' => 'I have some issues.',
        'owner_id' => factory(\App\User::class),
        'attachment' => $file = \Illuminate\Http\UploadedFile::fake()->create('test.jpg')->hashName()
    ];
});
