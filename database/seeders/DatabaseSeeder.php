<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->admin()->create([
            'name'  => 'Rafael Lunardelli',
            'email' => 'pinguim@dolaravel.com',
        ]);

        User::factory()->create([
            'name'  => 'Joe Doe',
            'email' => 'joe@dolaravel.com',
        ]);
    }
}
