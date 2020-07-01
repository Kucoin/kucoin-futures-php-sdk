<?php

namespace KuMEX\SDK\PublicApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Index
 * @package KuMEX\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#index
 */
class Index extends KuMEXApi
{
    /**
     * Get a list of index.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getList(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/index/query', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Get mark price.
     *
     * @param  string $symbol
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getMarkPrice($symbol)
    {
        $response = $this->call(Request::METHOD_GET, sprintf('/api/v1/mark-price/%s/current', $symbol));
        return $response->getApiData();
    }

    /**
     * Get a interest list of index.
     *
     * @param  array $pagination
     * @return array
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getPremium(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/premium/query', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Get current funding rate.
     *
     * @param  string $symbol
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getCurrentFundingRate($symbol)
    {
        $response = $this->call(Request::METHOD_GET, sprintf('/api/v1/funding-rate/%s/current', $symbol));
        return $response->getApiData();
    }
}
