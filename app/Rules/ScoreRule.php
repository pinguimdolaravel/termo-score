<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ScoreRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^[1-6X]\/6$/', $value);
    }

    public function message(): string
    {
        return 'Deu ruim no score';
    }
}
