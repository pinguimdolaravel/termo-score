<?php

namespace App\Actions;

abstract class Actionable
{
    abstract public function handle();

    /**
     * @see static::handle()
     */
    public static function run(...$arguments)
    {
        return app(static::class)->handle(...$arguments);
    }
}
