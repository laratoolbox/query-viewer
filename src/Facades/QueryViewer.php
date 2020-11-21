<?php

namespace LaraToolbox\QueryViewer\Facades;

use Illuminate\Support\Facades\Facade;

class QueryViewer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'query-viewer';
    }
}
