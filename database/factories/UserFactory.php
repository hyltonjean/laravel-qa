<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Answer;
use App\Question;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(mt_rand(5, 10)), '.'),
        'body' => $faker->paragraph(mt_rand(3, 7), true),
        'views' => mt_rand(0, 10),
        // 'answers_count' => mt_rand(0, 10),
        'votes' => mt_rand(-3, 10),
    ];
});

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(mt_rand(3, 7)),
        'user_id' => User::pluck('id')->random(),
        'votes_count' => mt_rand(0, 5),
    ];
});
