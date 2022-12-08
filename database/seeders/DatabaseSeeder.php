<?php

namespace Database\Seeders;

use App\Jobs\CheckDailyScoreJob;
use App\Models\DailyScore;
use App\Models\Group;
use App\Models\User;
use App\Models\WordOfDay;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $rafael = User::factory()->admin()->create([
            'name'  => 'Rafael Lunardelli',
            'email' => 'pinguim@dolaravel.com',
        ]);

        $joe = User::factory()->create([
            'name'  => 'Joe Doe',
            'email' => 'joe@dolaravel.com',
        ]);

        $users = User::factory()->count(30)->create();

        $groups = Group::factory()->count(20)->create(['user_id' => $rafael->id]);
        foreach ($groups as $group) {
            $group->users()->attach($rafael, ['created_at' => now()->subMonths(4)]);
            $group->users()->attach($joe, ['created_at' => now()->subMonth()]);
            foreach ($users as $user) {
                $group->users()->attach($user, ['created_at' => now()->subMonths(rand(1, 4))]);
            }
        }

//        GroupInvitation::create([
//            'group_id' => $group->id,
//            'user_id'  => $rafael->id,
//            'email'    => $joe->email,
//        ]);


        // 7 Word Of DAy
        $words = WordOfDay::factory()
            ->count(90)
            ->sequence(fn ($sequence) => ['game_id' => $sequence->index + 1])
            ->create();

        foreach ($words as $index => $word) {
            DailyScore::factory()
                ->for($rafael, 'user')
                ->create([
                    'word'       => $word->word,
                    'game_id'    => $word->game_id,
                    'created_at' => now()->subDays($index),
                ]);

            DailyScore::factory()
                ->for($joe, 'user')
                ->create([
                    'word'       => $word->word,
                    'game_id'    => $word->game_id,
                    'created_at' => now()->subDays($index),
                ]);
            foreach ($users as $user) {
                DailyScore::factory()
                    ->for($user, 'user')
                    ->create([
                        'word'       => $word->word,
                        'game_id'    => $word->game_id,
                        'created_at' => now()->subDays($index),
                    ]);
            }
        }

        DailyScore::all()->each(function (DailyScore $score) {
            $wordOfTheDay = WordOfDay::whereGameId($score->game_id)->first();

            CheckDailyScoreJob::dispatch($wordOfTheDay, $score);
        });

//        DailyScore::factory()->for($joe, 'user')->count(20)->create();
    }
}
