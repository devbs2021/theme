<?php

namespace Devbs\Theme\Facades;

use Illuminate\Support\Facades\Facade;

class ThemeFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'theme';
    }
}
