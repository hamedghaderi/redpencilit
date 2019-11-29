<?php

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'owner_id' => function () {
            return factory(User::class)->create()->id;
        },
        'excerpt' => "This is an excerpt.",
        'title' => 'Learning Laravel in 30 Days',
        'body' => 'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in most web projects.'
    ];
});
