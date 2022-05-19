<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DetailRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        foreach (explode(PHP_EOL, $value) as $row) {
            if (!preg_match('/^(⬛|🟨|🟩){5}$/', $row)) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'The validation error message.';
    }
}
