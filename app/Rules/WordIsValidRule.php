<?php

namespace App\Rules;

use App\Models\WordOfDay;
use Illuminate\Contracts\Validation\Rule;

class WordIsValidRule implements Rule
{
    protected string $attribute;

    public function __construct(
        protected string $gameId
    ) {
        //
    }

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        $wordOfTheDay = WordOfDay::query()
            ->where('game_id', str($this->gameId)->replace('#', ''))
            ->first();

        if (!$wordOfTheDay) {
            return true;
        }

        return $wordOfTheDay->word === $value;
    }

    public function message(): string
    {
        return __('validation.exists', ['attribute' => $this->attribute]);
    }
}
