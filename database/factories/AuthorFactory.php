<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {


    $name = $faker->name;
    $rating = rand(1,5);
    $create = $faker->dateTimeBetween('-30 days', '-1 days');

    return [
        'name' => $name,
        'rating' => $rating,
        'created_at' => $create
    ];
});
