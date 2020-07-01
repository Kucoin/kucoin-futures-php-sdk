<?php

namespace KuMEX\SDK\PrivateApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Account
 * @package KuMEX\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#account
 */
class Account extends KuMEXApi
{
    /**
     * Get an account overview.
     *
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getOverview(array $params = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/account-overview', $params);
        return $response->getApiData();
    }

    /**
     * Get a transaction history of accounts.
     *
     * @param  array $params
     * @param  array $pagination
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getTransactionHistory(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/transaction-history', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * @deprecated
     *
     * KuCoin transfer to KuMEX account.
     *
     * @param  number amount
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function transferIn($amount)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/transfer-in', compact('amount'));
        return $response->getApiData();
    }

    /**
     * KuMEX transfer to KuCoin account.
     *
     * @param  string bizNo
     * @param  number amount
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function transferOut($bizNo, $amount)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/transfer-out', compact('bizNo', 'amount'));
        return $response->getApiData();
    }

    /**
     * Cancel an transfer out.
     *
     * @param  string $applyId
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function cancelTransferOut($applyId)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/cancel/transfer-out?applyId=' . $applyId);
        return $response->getApiData();
    }

    /**
     * Get a transfer list.
     *
     * @param  array $params
     * @param  array $pagination
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getTransferList(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/transfer-list', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * KuMEX transfer to KuCoin account.
     *
     * @param  string bizNo
     * @param  number amount
     * @param  string currency
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function transferOutV2($bizNo, $amount, $currency)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/transfer-out', compact('bizNo', 'amount', 'currency'));
        return $response->getApiData();
    }
}
