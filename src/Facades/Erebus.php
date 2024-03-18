<?php

namespace LaraZeus\Erebus\Facades;

use Illuminate\Support\Facades\Facade;

class Erebus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'erebus';
    }
}
