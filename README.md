# live-video-broadcast-manager
Laravel live video broadcast manager for Tencent LVB service integration

## Installation
To  install, run `composer require bryanthw1020/live-video-broadcast-manager`.

After installation, run `php artisan vendor:publish` to publish the configuration file.

After publishing configuration please make sure to add variables below into your `env` file
```
TC_LVB_SECRET_ID=
TC_LVB_SECRET_KEY=
TC_LVB_STREAM_DOMAIN=
TC_LVB_PLAYBACK_DOMAIN=
```

## Usage
Below are the available method to use.

```php
# Get Online Live Stream List
LiveVideoBroadcastManager::liveStreamOnlineList(string $region = "ap-singapore", string $endpoint = "live.tencentcloudapi.com", int $pageNum = 1, int $pageSize = 20);
## Example
LiveVideoBroadcastManager::liveStreamOnlineList();

# Block Live Stream
LiveVideoBroadcastManager::blockLiveStream(string $streamName, string $reason, string $appName = "live", string $region = "ap-singapore", string $endpoint = "live.tencentcloudapi.com");
## Example
LiveVideoBroadcastManager::blockLiveStream("1400292776_959_118_main", "Forbidden equipment on air.");

# Resume Live Stream
LiveVideoBroadcastManager::resumeLiveStream(string $streamName, string $appName = "live", string $region = "ap-singapore", string $endpoint = "live.tencentcloudapi.com");
## Example
LiveVideoBroadcastManager::resumeLiveStream("1400292776_959_118_main");
```
