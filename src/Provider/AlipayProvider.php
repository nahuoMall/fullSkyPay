<?php

namespace FullSky\Api\Provider;

use FullSky\Api\Core\Container;
use FullSky\Api\Functions\Alipay\AppPayShortcut;
use FullSky\Api\Interfaces\Provider;

/**
 * Class FullSkyProvider
 * @package FullSky\Api\Provider
 */
class AlipayProvider implements Provider
{

    /**
     * 服务提供者
     * @param Container $container
     */
    public function serviceProvider(Container $container): void
    {
        $container['alipayApp'] = function ($container) {
            return new AppPayShortcut($container, '/v1/netpay/');
        };
    }
}
