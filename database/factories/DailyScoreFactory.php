<?php

namespace Database\Factories;

use App\Models\DailyScore;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyScoreFactory extends Factory
{
    protected $model = DailyScore::class;

    public function definition(): array
    {
        return [
            'game_id' => 81,
            'score'   => '1/6',
            'detail'  => 'joguei term.ooo #81 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩',
            'word'    => $this->faker->text(5),
            'status'  => 'pending',
        ];
    }
}
