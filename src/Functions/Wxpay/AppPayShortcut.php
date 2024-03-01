<?php

namespace FullSky\Api\Functions\Wxpay;

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
        $this->url = 'wx/app-pre-order';

        $params['foodOrderType'] = 'pre_order';

        return $this->curlRequest($params, 'post');
    }


}
