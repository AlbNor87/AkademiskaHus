<?php

use Faker\Generator as Faker;

$factory->define(App\Malfunction::class, function (Faker $faker) {
    return [
        'title'    => $faker->text(20),
        'summary'  => $faker->text(40),
        'body'     => $faker->text(100),
        'location' => $faker->text(40),
    ];
});
