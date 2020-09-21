<?php

namespace Alexievbgn\BladeIndexTag\Facades;

use Illuminate\Support\Facades\Facade;

class BladeIndexTag extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bladeindextag';
    }
}
