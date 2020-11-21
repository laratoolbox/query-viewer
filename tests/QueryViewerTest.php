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

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
