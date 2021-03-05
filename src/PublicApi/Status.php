<?php

namespace KuCoin\Futures\SDK\PublicApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Time
 * @package KuCoin\Futures\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#get-the-service-status
 */
class Status extends KuCoinFuturesApi
{
    /**
     * Get the timestamp of Server in milliseconds
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function status()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/status');
        return $response->getApiData();
    }
}