<?php

namespace FullSky\Api\Functions\Public;

use GuzzleHttp\Exception\GuzzleException;
use FullSky\Api\Core\BaseClient;

/**
 * 退款模块
 */
class OrderRefund extends BaseClient
{
    /**
     * 统一退款
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function refund(array $params): array
    {
        $this->url = 'refund';
        return $this->curlRequest($params, 'post');
    }
}