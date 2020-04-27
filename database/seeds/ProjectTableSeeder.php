<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();

        factory(App\User::class, 3)->create()->each(function ($user) {
            factory(App\Question::class, mt_rand(1, 5))->create(['user_id' => $user->id])
                ->each(function ($q) {
                    factory(App\Answer::class, mt_rand(1, 5))->create(['question_id' => $q->id]);
                });
        });
    }
}
