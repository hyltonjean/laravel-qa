<?php

use App\User;
use App\Answer;
use App\Question;
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
            factory(App\Question::class, mt_rand(1, 5))->create(['user_id' => $user->id])
                ->each(function ($q) {
                    factory(App\Answer::class, mt_rand(1, 5))->create(['question_id' => $q->id]);
                });
        });

        //     factory(User::class, 3)->create()->each(function ($u) {
        //         $u->questions()->saveMany(
        //             factory(Question::class, mt_rand(1, 5))->make()
        //         )->each(function ($q) {
        //             $q->answers()->saveMany(
        //                 factory(Answer::class, mt_rand(1, 5))->make()
        //             );
        //         });
        //     });
    }
}
