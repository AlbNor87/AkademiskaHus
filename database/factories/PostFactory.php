<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(200) 
    ];
});
