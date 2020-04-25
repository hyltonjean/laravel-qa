<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(mt_rand(5, 10)), '.'),
        'body' => $faker->paragraphs(mt_rand(3, 7), true),
        'views' => mt_rand(0, 10),
        'answers' => mt_rand(0, 10),
        'votes' => mt_rand(-3, 10),
    ];
});
