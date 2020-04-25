<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create()->each(function ($user) {
            factory(App\Question::class, mt_rand(1, 5))->create(['user_id' => $user->id]);
        });
    }
}
