<?php
namespace FullSky\Api;

use FullSky\Api\Core\ContainerBase;
use FullSky\Api\Provider\AlipayProvider;
use FullSky\Api\Provider\CloseProvider;
use FullSky\Api\Provider\RefundProvider;
use FullSky\Api\Provider\SearchProvider;
use FullSky\Api\Provider\WxpayProvider;

/**
 * Class Application
 */
class FullSky extends ContainerBase
{

    /**
     * 服务提供者
     * @var array
     */
    protected array $provider = [
        AlipayProvider::class,
        WxpayProvider::class,
        SearchProvider::class,
        RefundProvider::class,
        CloseProvider::class,
        //...其他服务提供者
    ];
}
