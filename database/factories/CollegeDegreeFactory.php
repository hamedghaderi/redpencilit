<?php

use Faker\Generator as Faker;

$factory->define(App\CollegeDegree::class, function (Faker $faker) {
    return [
        'name' => json_encode(['fa' => 'کارشناسی', 'en' => 'Bachelors'])
    ];
});
