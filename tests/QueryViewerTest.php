<?php

namespace LaraToolbox\QueryViewer\Tests;

use LaraToolbox\QueryViewer\Facades\QueryViewer;
use LaraToolbox\QueryViewer\QueryViewerServiceProvider;
use Orchestra\Testbench\TestCase;

class QueryViewerTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [QueryViewerServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'query-viewer' => QueryViewer::class,
        ];
    }

    public function testGetSqlMethodExistsOnEloquentBuilder()
    {
        $this->assertEquals(
            'select `name` from `test_table` where `id` = 5',
            EloquentBuilderTestModel::select('name')->where('id', 5)->getSql()
        );
    }

    public function testGetSqlMethodExistsOnDatabaseBuilder()
    {
        $this->assertEquals(
            'select `name` from `test_table` where `id` = 5',
            \DB::table('test_table')->select('name')->where('id', 5)->getSql()
        );
    }
}

class EloquentBuilderTestModel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'test_table';
}

;
