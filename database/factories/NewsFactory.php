<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {

    $title = $faker->title;
    $text = $faker->realText(rand(10,500));
    $description = mb_strlen($text)>30 ? mb_substr($text, 0, 30) . '...' : $text;
    $created = $faker->dateTimeBetween('-30 days', '-1 days');

    return [
        'title' => $title,
        'author_id'=>rand(1,4),
        'created_at'=>$created,
        'description'=>$description,
        'text'=>$text,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at

    ];
});
