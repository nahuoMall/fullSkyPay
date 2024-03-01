<?php

namespace FullSky\Api\Core;


/**
 * Class ContainerBase
 * @package FullSky\Api\Core
 */
class ContainerBase extends Container
{
    protected array $provider = [];
    public string $mchId = '';
    public string $appId = '';
    public string $appKey = '';
    public string $terminalId = '';

    public string $service = '';
    public array $baseParams = [
        'instMid' => 'APPDEFAULT',
    ];

    /**
     * ContainerBase constructor.
     */
    public function __construct(array $params = [])
    {
        if (!empty($params)) {
            $this->baseParams = $params;
        }

        $providerCallback = function ($provider) {
            $obj = new $provider;
            $this->serviceRegister($obj);
        };

        array_walk($this->provider, $providerCallback);//注册
    }

    /**
     * @param $id
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @param string $mchId
     * @return ContainerBase
     */
    public function setMchId(string $mchId): static
    {
        $this->mchId = $mchId;
        return $this;
    }

    /**
     * @param string $appId
     * @return ContainerBase
     */
    public function setAppId(string $appId): static
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * @param string $appKey
     * @return ContainerBase
     */
    public function setAppKey(string $appKey): static
    {
        $this->appKey = $appKey;
        return $this;
    }

    /**
     * @param string $terminalId
     * @return ContainerBase
     */
    public function setTerminalId(string $terminalId): static
    {
        $this->terminalId = $terminalId;
        return $this;
    }


}
