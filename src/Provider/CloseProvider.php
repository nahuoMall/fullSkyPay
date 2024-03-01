<?php

namespace FullSky\Api\Provider;

use FullSky\Api\Core\Container;
use FullSky\Api\Functions\Public\OrderClose;
use FullSky\Api\Interfaces\Provider;

/**
 * Class FullSkyProvider
 * @package FullSky\Api\Provider
 */
class CloseProvider implements Provider
{

    /**
     * 服务提供者
     * @param Container $container
     */
    public function serviceProvider(Container $container): void
    {
        $container['close'] = function ($container) {
            return new OrderClose($container, '/v1/netpay/');
        };
    }
}
