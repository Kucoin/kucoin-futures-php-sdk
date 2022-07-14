<?php

namespace KuCoin\Futures\SDK\PublicApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Index
 * @package KuCoin\Futures\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#index
 */
class Index extends KuCoinFuturesApi
{
    /**
     * Get a list of index.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getList(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/index/query', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Get mark price.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2MarkPrice instead
     *
     */
    public function getMarkPrice($symbol)
    {
        $response = $this->call(Request::METHOD_GET, sprintf('/api/v1/mark-price/%s/current', $symbol));
        return $response->getApiData();
    }

    /**
     * Get a interest list of index.
     *
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getInterests(array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/interest/query', $pagination);
        return $response->getApiData();
    }

    /**
     * Get a premium of index list.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getPremium(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/premium/query', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Get current funding rate.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2FundingRate instead
     *
     */
    public function getCurrentFundingRate($symbol)
    {
        $response = $this->call(Request::METHOD_GET, sprintf('/api/v1/funding-rate/%s/current', $symbol));
        return $response->getApiData();
    }
}
