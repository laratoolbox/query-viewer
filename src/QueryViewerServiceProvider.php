<?php

namespace LaraToolbox\QueryViewer;

use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class QueryViewerServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/query-viewer.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('query-viewer.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'query-viewer'
        );

        EloquentQueryBuilder::mixin(new QueryBuilderMixin());
        QueryBuilder::mixin(new QueryBuilderMixin());
    }
}
