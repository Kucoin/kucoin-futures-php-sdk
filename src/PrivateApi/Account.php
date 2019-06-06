<?php

namespace KuMex\SDK\PrivateApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Account
 * @package KuMex\SDK\PrivateApi
 * @see https://docs.KuMex.com/#accounts
 */
class Account extends KuMexApi
{
    /**
     * Get an account overview.
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getOverview()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/account-overview');
        return $response->getApiData();
    }

    /**
     * Get a transaction history of accounts.
     * @param  array $params
     * @param  array $pagination
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getTransactionHistory(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/transaction-history', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * KuCoin transfer to KuMex account.
     * @param  number amount
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function transferIn($amount)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1//transfer-in', $amount);
        return $response->getApiData();
    }

    /**
     * KuMex transfer to KuCoin account.
     * @param  string bizNo
     * @param  number amount
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function transferOut($bizNo, $amount)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1//transfer-out', compact('bizNo', 'amount'));
        return $response->getApiData();
    }
}