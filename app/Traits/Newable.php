<?php

namespace App\Traits;

trait Newable
{
    public static function resolve(): self
    {
        return app(static::class, func_get_args());
    }

    public static function new(): self
    {
        $class = static::class;
        return new $class(func_get_args());
    }
}
