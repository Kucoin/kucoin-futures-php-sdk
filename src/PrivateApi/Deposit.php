<?php

namespace KuMex\SDK\PrivateApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Deposits
 * @package KuMex\SDK\PrivateApi
 * @see https://docs.KuMex.com/#deposits
 */
class Deposit extends KuMexApi
{
    /**
     * Create deposit address
     * @param string $currency
     * @param string|null $chain
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function createAddress($currency, $chain = null)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/deposit-addresses', compact('currency', 'chain'));
        return $response->getApiData();
    }

    /**
     * Get deposit address of currency for deposit
     * @param string $currency
     * @param string|null $chain
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getAddress($currency, $chain = null)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/deposit-addresses', compact('currency', 'chain'));
        return $response->getApiData();
    }

    /**
     * Get deposit list
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getDeposits(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/deposits', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Get v1 historical deposits list
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getV1Deposits(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/hist-deposits', $params + $pagination);
        return $response->getApiData();
    }
}