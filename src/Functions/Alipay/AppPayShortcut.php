<?php

namespace FullSky\Api\Functions\Alipay;

use GuzzleHttp\Exception\GuzzleException;
use FullSky\Api\Core\BaseClient;

/**
 * app订单模块
 */
class AppPayShortcut extends BaseClient
{

    /**
     * 创建订单
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function createOrder(array $params): array
    {
        $this->url = 'trade/precreate';

        return $this->curlRequest($params, 'post');
    }


}
