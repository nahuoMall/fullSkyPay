<?php

namespace FullSky\Api\Functions\Public;

use FullSky\Api\Core\BaseClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 关闭模块
 */
class OrderClose extends BaseClient
{
    /**
     * 统一关闭订单
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function closeOrder(array $params): array
    {
        $this->url = 'close';

        return $this->curlRequest($params, 'post');
    }
}