<?php

namespace FullSky\Api\Provider;

use FullSky\Api\Core\Container;
use FullSky\Api\Functions\WxPay\AppPayShortcut;
use FullSky\Api\Functions\Public\OrderDetail;
use FullSky\Api\Functions\Public\OrderRefund;
use FullSky\Api\Interfaces\Provider;

/**
 * Class FullSkyProvider
 * @package FullSky\Api\Provider
 */
class SearchProvider implements Provider
{

    /**
     * 服务提供者
     * @param Container $container
     */
    public function serviceProvider(Container $container): void
    {
        $container['search'] = function ($container) {
            return new OrderDetail($container, '/v1/netpay/');
        };
        $container['refund_search'] = function ($container) {
            return new OrderRefund($container, '/v1/netpay/');
        };
    }
}
