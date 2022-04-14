<?php

namespace Database\Factories;

use App\Models\WordOfDay;
use Illuminate\Database\Eloquent\Factories\Factory;

class WordOfDayFactory extends Factory
{
    protected $model = WordOfDay::class;

    public function definition(): array
    {
        return [
            'game_id' => $this->faker->numberBetween(1, 100),
            'word'    => $this->faker->text(5),
        ];
    }
}
