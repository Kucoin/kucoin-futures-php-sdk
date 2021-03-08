<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Deposits
 * @package KuCoin\Futures\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#deposit
 */
class Deposit extends KuCoinFuturesApi
{
    /**
     * Get deposit address of currency for deposit.
     *
     * @param  string $currency
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getDeposits(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/deposit-list', $params + $pagination);
        return $response->getApiData();
    }
}
