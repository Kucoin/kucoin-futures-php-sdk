<?php

namespace KuMex\SDK\PublicApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Index
 * @package KuMex\SDK\PublicApi
 * @see https://docs.KuMex.com/#index
 */
class Index extends KuMexApi
{
    /**
     * Get a list of index.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getCurrentFundingRate($symbol)
    {
        $response = $this->call(Request::METHOD_GET, sprintf('/api/v1/funding-rate/%s/current', $symbol));
        return $response->getApiData();
    }
}
