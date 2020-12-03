<?php

namespace bryanthw1020\LiveVideoBroadcastManager\Tests;

use \Orchestra\Testbench\TestCase as OrchestraTestCase;
use bryanthw1020\LiveVideoBroadcastManager\LiveVideoBroadcastManagerServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LiveVideoBroadcastManagerServiceProvider::class,
        ];
    }
}
