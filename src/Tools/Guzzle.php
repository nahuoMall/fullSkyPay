<?php

namespace FullSky\Api\Tools;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use Hyperf\Codec\Json;
use FullSky\Api\Constants\FullSkyErrorCode;
use Hyperf\Guzzle\CoroutineHandler;
use Psr\Http\Message\ResponseInterface;
use FullSky\Api\Exception\PayException;

class Guzzle
{
    private Client $client;

    protected array $headers = [
        'Content-Type' => 'application/json',
    ];

    /**
     * @param array $options
     * @return $this
     */
    public function setHttpHandle(array $options = []): static
    {
        $options['handler'] = HandlerStack::create(new CoroutineHandler());

        $options['headers'] = array_merge($this->headers, $options['headers'] ?? []);

        $this->client = new Client($options);

        return $this;
    }

    /**
     * @throws GuzzleException
     */
    public function sendGet(string $url, array $params): array
    {
        $result = $this->client->get($url, ['query' => $params]);

        return $this->getResult($result);
    }

    /**
     * @param string $url
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function sendPost(string $url, array $params): array
    {
        logger('fullskypay')->info('FullSkyPay POST', ['url' => $url, 'params' => $params]);

        try {
            $result = $this->client->post($url, ['json' => $params]);

        } catch (\Exception $exception) {
            $errorMsg = explode("response:", $exception->getMessage());
            if (!empty($errorMsg[1])) {
                return $this->getErrorResult(Json::decode($errorMsg[1]));
            }
        }

        return !empty($result) ? $this->getResult($result) : [];
    }

    /**
     * @param ResponseInterface|array $response
     * @return array
     */
    private function getResult(ResponseInterface|array $response): array
    {
        $result = $response->getBody()->getContents();

        $statusCode = $response->getStatusCode();

        $result = Json::decode($result);

        logger('fullskypay')->info('FullSkyPay POST RESULT', $result);

        if (empty($result) || $statusCode != 200) {
            throw new PayException(FullSkyErrorCode::ORDER_SERVICE_ERROR, '请求银联天满支付服务错误');
        }

        return $result;
    }

    /**
     * @param array $result
     * @return array
     */
    private function getErrorResult(array $result): array
    {
        logger('fullskypay')->info('FullSkyPay POST ERROR RESULT', $result);

        if (empty($result)) {
            throw new PayException(FullSkyErrorCode::ORDER_SERVICE_ERROR, '请求银联天满支付服务错误');
        }

        if ($result['errCode'] != "SUCCESS") {
            throw new PayException(FullSkyErrorCode::PAY_POST_ERROR, !empty($result['errMsg']) && is_string($result['errMsg']) ? $result['errMsg'] : null);
        }

        return $result;
    }

}