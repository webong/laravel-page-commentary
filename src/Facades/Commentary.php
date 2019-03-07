<?php

namespace CreativityKills\Commentary\Facades;

use Illuminate\Support\Facades\Facade;

class Commentary extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'commentary';
    }
}
