<?php

namespace JordanDalton\LaravelAI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JordanDalton\LaravelAI\Skeleton
 */
class Ai extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \JordanDalton\LaravelAI\Skeleton::class;
    }
}
