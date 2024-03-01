<?php

namespace FullSky\Api\Functions\Public;

use GuzzleHttp\Exception\GuzzleException;
use FullSky\Api\Core\BaseClient;

/**
 * 订单模块
 */
class OrderDetail extends BaseClient
{

    /**
     * 统一查询订单
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function getInfo(array $params): array
    {
        $this->url = 'query';

        return $this->curlRequest($params, 'post');
    }

}
