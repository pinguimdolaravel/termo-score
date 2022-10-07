<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
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

        $group = Group::factory()->create(['user_id' => $rafael->id, 'name' => 'Pinguim do Laravel']);

        GroupInvitation::create([
            'group_id' => $group->id,
            'user_id'  => $rafael->id,
            'email'    => $joe->email,
        ]);

//        DailyScore::factory()->for($rafael, 'user')->count(20)->create();
//        DailyScore::factory()->for($joe, 'user')->count(20)->create();
    }
}
