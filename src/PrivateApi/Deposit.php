<?php

namespace KuMEX\SDK\PrivateApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Deposits
 * @package KuMEX\SDK\PrivateApi
 * @see https://docs.KuMEX.com/#deposits
 */
class Deposit extends KuMEXApi
{
    /**
     * Get deposit address of currency for deposit.
     *
     * @param  string $currency
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getDeposits(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/deposit-list', $params + $pagination);
        return $response->getApiData();
    }
}
