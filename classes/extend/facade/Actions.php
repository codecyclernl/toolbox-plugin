<?php namespace Codecycler\Toolbox\Classes\Extend\Facade;

use Illuminate\Support\Facades\Facade;
use Codecycler\Toolbox\Classes\Extend\ActionManager;

class Actions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ActionManager::class;
    }
}