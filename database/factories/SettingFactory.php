<?php

use Faker\Generator as Faker;

$factory->define(App\Setting::class, function (Faker $faker) {
    return [
        'upload_articles_per_day' => $faker->numberBetween(1, 4),
        'upload_words_per_day' => $faker->numberBetween(15000, 20000),
        'price_per_word' => $faker->numberBetween(10, 100),
        'base_price_for_docs' => $faker->numberBetween(50000, 100000),
        'owner_id' => function() {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
