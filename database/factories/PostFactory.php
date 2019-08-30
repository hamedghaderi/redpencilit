<?php

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'owner_id' => factory(User::class)->create()->id,
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});
