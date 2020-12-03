<?php

namespace bryanthw1020\LiveVideoBroadcastManager;

use Illuminate\Support\Collection;

class LiveStreamOnlineList
{
    /**
     * @var string
     */
    public $request_id;

    /**
     * @var array
     */
    public $data;

    /**
     * @var array
     */
    public $pagination;

    /**
     * LiveStreamOnlineList constructor.
     *
     * @param string $requestId
     * @param array $data
     * @param int $pageNum
     * @param int $pageSize
     * @param int $totalPage
     * @param int $totalNum
     */
    public function __construct(string $requestId, array $data, int $pageNum, int $pageSize, int $totalPage, int $totalNum)
    {
        $this->request_id = $requestId;
        $this->data = $this->beautifyData($data);
        $this->pagination = [
            "total" => $totalNum,
            "current_page" => $pageNum,
            "last_page" => $totalPage,
            "per_page" => $pageSize
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function beautifyData($data): array
    {
        return Collection::make($data)->map(function ($onlineStream) {
            $url = config('livevideobroadcastmanager.playback_domain') . "/{$onlineStream->AppName}/{$onlineStream->StreamName}";

            return [
                "stream_urls" => [
                    "rtmp" => "rtmp://" . $url,
                    "flv" => "http://" . $url . ".flv",
                    "hls" => "http://" . $url . ".m3u8",
                ],
                "app_name" => $onlineStream->AppName,
                "domain_name" => $onlineStream->DomainName,
                "stream_name" => $onlineStream->StreamName
            ];
        })->all();
    }
}
