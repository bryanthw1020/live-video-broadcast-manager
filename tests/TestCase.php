<?php

namespace bryanthw1020\LiveVideoBroadcastManager\Tests;

use bryanthw1020\LiveVideoBroadcastManager\LiveVideoBroadcastManagerServiceProvider;
use \Orchestra\Testbench\TestCase as OrchestraTestCase;

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

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('livevideobroadcastmanager.secret_id', '');
        $app['config']->set('livevideobroadcastmanager.secret_key', '');
        $app['config']->set('livevideobroadcastmanager.stream_domain', '');
        $app['config']->set('livevideobroadcastmanager.playback_domain', '');
    }
}