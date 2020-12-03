<?php

namespace bryanthw1020\LiveVideoBroadcastManager;

use Illuminate\Support\ServiceProvider;

class LiveVideoBroadcastManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/livevideobroadcastmanager.php' => config_path('livevideobroadcastmanager.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/livevideobroadcastmanager.php', 'livevideobroadcastmanager');
    }
}
