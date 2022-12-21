<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DetailRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        // Between one and six lines with five squares each
        return preg_match('/^((⬛|🟨|🟩){5}'.PHP_EOL.'){0,5}(⬛|🟨|🟩){5}$/', $value);
    }

    public function message(): string
    {
        return 'The validation error message.';
    }
}
