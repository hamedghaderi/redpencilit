<?php

use Faker\Generator as Faker;

$factory->define(App\Testimonial::class, function (Faker $faker) {
    return [
        'body' => 'I fall in love with Redpencilit the moment I saw the design. Great jobs dude!',
        'author_id' => factory(\App\User::class),
        'comment_id' => factory(\App\Comment::class)
    ];
});
