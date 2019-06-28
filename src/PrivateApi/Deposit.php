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
     * Get deposit address of currency for deposit.
     *
     * @param  string $currency
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getAddress($currency)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/deposit-address', compact('currency'));
        return $response->getApiData();
    }

    /**
     * Get deposit list.
     *
     * @param  array $params
     * @param  array $pagination
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getDeposits(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/deposit-list', $params + $pagination);
        return $response->getApiData();
    }
}
