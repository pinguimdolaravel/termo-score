<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GameIdRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^#\d+$/', $value);
    }

    public function message(): string
    {
        return 'The validation error message.';
    }
}
