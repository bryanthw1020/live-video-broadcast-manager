<?php

namespace bryanthw1020\LiveVideoBroadcastManager;

use bryanthw1020\LiveVideoBroadcastManager\Exceptions\LiveVideoBroadcastManagerException;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Live\V20180801\LiveClient;
use TencentCloud\Live\V20180801\Models\DescribeLiveStreamOnlineListRequest;
use TencentCloud\Live\V20180801\Models\ForbidLiveStreamRequest;
use TencentCloud\Live\V20180801\Models\ResumeLiveStreamRequest;

class LiveVideoBroadcastManager
{
    private $client;

    private $clientProfile;

    private $credential;

    private $streamDomain;

    private $httpProfile;

    public function __construct(string $region, string $endpoint)
    {
        $this->credential = new Credential(config('livevideobroadcastmanager.secret_id'), config('livevideobroadcastmanager.secret_key'));
        $this->httpProfile = (new HttpProfile())->setEndpoint($endpoint);
        $this->clientProfile = (new ClientProfile())->setHttpProfile($this->httpProfile);
        $this->client = new LiveClient($this->credential, $region, $this->clientProfile);
        $this->streamDomain = config('livevideobroadcastmanager.stream_domain');
    }

    /**
     * Get all online live stream broadcast list
     *
     * @param string $region
     * @param string $endpoint
     * @param int $pageNum
     * @param int $pageSize
     *
     * @return \bryanthw1020\LiveVideoBroadcastManager\LiveStreamOnlineList
     */
    public static function liveStreamOnlineList(string $region = "ap-singapore", string $endpoint = "live.tencentcloudapi.com", int $pageNum = 1, int $pageSize = 20): LiveStreamOnlineList
    {
        try {
            $lvbManager = new self($region, $endpoint);
            $request = new DescribeLiveStreamOnlineListRequest();
            $request->fromJsonString(json_encode(["PageNum" => $pageNum, "PageSize" => $pageSize]));
            $response = $lvbManager->client->DescribeLiveStreamOnlineList($request);

            return new LiveStreamOnlineList($response->RequestId, $response->OnlineInfo, $response->PageNum, $response->PageSize, $response->TotalPage, $response->TotalNum);
        } catch (TencentCloudSDKException $ex) {
            throw new LiveVideoBroadcastManagerException($ex->getCode(), $ex->getMessage());
        } catch (\Exception $ex) {
            throw new LiveVideoBroadcastManagerException($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Block live stream from broadcasting
     *
     * @param string $streamName
     * @param string $reason
     * @param string $appName
     * @param string $region
     * @param string $endpoint
     *
     * @return array
     */
    public static function blockLiveStream(string $streamName, string $reason, string $appName = "live", string $region = "ap-singapore", string $endpoint = "live.tencentcloudapi.com"): array
    {
        try {
            $lvbManager = new self($region, $endpoint);
            $request = new ForbidLiveStreamRequest();
            $request->fromJsonString(json_encode(["AppName" => $appName, "DomainName" => $lvbManager->streamDomain, "StreamName" => $streamName, "Reason" => $reason]));
            $response = $lvbManager->client->ForbidLiveStream($request);

            return [
                "request_id" => $response->RequestId
            ];
        } catch (TencentCloudSDKException $ex) {
            throw new LiveVideoBroadcastManagerException($ex->getCode(), $ex->getMessage());
        } catch (\Exception $ex) {
            throw new LiveVideoBroadcastManagerException($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Resume blocked live stream
     *
     * @param string $streamName
     * @param string $appName
     * @param string $region
     * @param string $endpoint
     *
     * @return array
     */
    public static function resumeLiveStream(string $streamName, string $appName = "live", string $region = "ap-singapore", string $endpoint = "live.tencentcloudapi.com"): array
    {
        try {
            $lvbManager = new self($region, $endpoint);
            $request = new ResumeLiveStreamRequest();
            $request->fromJsonString(json_encode(["AppName" => $appName, "DomainName" => $lvbManager->streamDomain, "StreamName" => $streamName]));
            $response = $lvbManager->client->ResumeLiveStream($request);

            return [
                "request_id" => $response->RequestId
            ];
        } catch (TencentCloudSDKException $ex) {
            throw new LiveVideoBroadcastManagerException($ex->getCode(), $ex->getMessage());
        } catch (\Exception $ex) {
            throw new LiveVideoBroadcastManagerException($ex->getCode(), $ex->getMessage());
        }
    }
}