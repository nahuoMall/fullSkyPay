<?php

namespace FullSky\Api\Provider;

use FullSky\Api\Core\Container;
use FullSky\Api\Functions\WxPay\AppPayShortcut;
use FullSky\Api\Interfaces\Provider;

/**
 * Class FullSkyProvider
 * @package FullSky\Api\Provider
 */
class WxpayProvider implements Provider
{

    /**
     * 服务提供者
     * @param Container $container
     */
    public function serviceProvider(Container $container): void
    {
        $container['wechatApp'] = function ($container) {
            return new AppPayShortcut($container, '/v1/netpay/');
        };
    }
}
