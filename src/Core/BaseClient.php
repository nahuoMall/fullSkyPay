<?php

namespace FullSky\Api\Core;

use GuzzleHttp\Exception\GuzzleException;
use FullSky\Api\Tools\Guzzle;
use FullSky\Api\Tools\Sign;
use Hyperf\Codec\Json;
use function Hyperf\Support\make;
use function Hyperf\Config\config;

/**
 * Class BaseClient
 * @package FullSky\Api\Core
 * @property BaseClient app
 */
class BaseClient
{
    use Sign;

    protected Container $app;
    public string $host = 'https://test-api-open.chinaums.com';
    public string $url = '';
    public string $service = '';

    /**
     * BaseClient constructor.
     * @param Container $app
     * @param string $service
     */
    public function __construct(Container $app, string $service)
    {
        $payApp = config('pay.fullskypay.pay_app');
        $this->app = $app;
        $this->service = $service;
        $this->host = $payApp == 'prod' ? 'https://api-mop.chinaums.com' : 'https://test-api-open.chinaums.com';
    }

    /**
     * curl 请求
     * @param array $data
     * @param string $method
     * @param int $timeout
     * @return array
     * @throws GuzzleException
     */
    public function curlRequest(array $data, string $method = 'get', int $timeout = 10): array
    {
        ## 设置商户ID
        $data['mid'] = $this->app->mchId;
        ##  设置终端ID
        $data['tid'] = $this->app->terminalId;
        ## 设置唯一消息ID
        $data['msgId'] = uniqid() . uniqid();
        ## 设置请求时间
        $data['requestTimestamp'] = date("YmdHis",time());
        ## 合并参数
        $data = array_merge($this->app->baseParams, $data);
        ## 开始请求
        /** @var Guzzle $client */
        $client = make(Guzzle::class);
        ## 设置请求参数
        $client->setHttpHandle(
            [
                'base_uri' => $this->host,
                'timeout' => $timeout,
                'verify' => false,
                'headers' => [
                    'Content-Length' => strlen(Json::encode($data)),
                    'Authorization' => self::getSign(Json::encode($data)),
                ],
            ]
        );

        $method = 'send' . ucfirst($method);

        return $client->$method($this->service . $this->url, $data);
    }

}
