<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name'  => 'Tio Jobs',
            'email' => 'pinguim@dolaravel.com'
        ]);

        User::factory()->count(10)->create();
    }
}
