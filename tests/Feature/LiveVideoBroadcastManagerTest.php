<?php

namespace bryanthw1020\LiveVideoBroadcastManager\Tests;

use bryanthw1020\LiveVideoBroadcastManager\LiveStreamOnlineList;
use bryanthw1020\LiveVideoBroadcastManager\LiveVideoBroadcastManager;

class LiveVideoBroadcastManagerTest extends TestCase
{
    /** @test */
    public function can_get_currently_streaming_list()
    {
        $response = LiveVideoBroadcastManager::liveStreamOnlineList();
        $this->assertInstanceOf(LiveStreamOnlineList::class, $response);
    }

    /** @test */
    public function can_forbid_stream()
    {
        $response = LiveVideoBroadcastManager::blockLiveStream("1400292776_959_118_main", "Forbidden equipment on air.");
        $this->assertIsArray($response);
        $this->assertArrayHasKey('request_id', $response);
    }

    /** @test */
    public function can_resume_stream()
    {
        $response = LiveVideoBroadcastManager::resumeLiveStream("1400292776_959_118_main");
        $this->assertIsArray($response);
        $this->assertArrayHasKey('request_id', $response);
    }
}
