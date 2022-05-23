<?php

namespace KuCoin\Futures\SDK\PrivateApi\V2;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Account
 * @package KuCoin\Futures\SDK\PrivateApi\V2
 *
 * @see https://docs.kucoin.com/futures/new/#account
 */
class Account extends KuCoinFuturesApi
{
    /**
     * Get account overview.
     *
     * @param array $params
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Overview(array $params = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/account-overview', $params);
        return $response->getApiData();
    }

    /**
     * Query Fund Record.
     *
     * @param array $params
     * @param array $pagination
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2TransactionHistory(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/transaction-history', $params + $pagination);
        return $response->getApiData();
    }


    ///**
    // * Get the list of all sub-accounts.
    // *
    // * @return mixed|null
    // * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
    // * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
    // * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
    // */
    //public function getV2SubAccounts()
    //{
    //    $response = $this->call(Request::METHOD_GET, '/api/v2/sub-accounts');
    //    return $response->getApiData();
    //}

    /**
     * Transfer out to KuCoin main/trading account.
     *
     * @param string $amount
     * @param string $currency
     * @param string $recAccountType
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function transferOutV2($amount, $currency, $recAccountType)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/transfer-out', compact('amount', 'currency', 'recAccountType'));
        return $response->getApiData();
    }

    /**
     * Query transfer out request record.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2TransferList(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/transfer-list', $params + $pagination);
        return $response->getApiData();
    }

    ///**
    // * Cancel an transfer out.
    // *
    // * @param string $applyId
    // * @return array
    // * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
    // * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
    // * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
    // */
    //public function cancelV2TransferOut($applyId)
    //{
    //    $response = $this->call(Request::METHOD_DELETE, '/api/v2/cancel/transfer-out', compact('applyId'));
    //    return $response->getApiData();
    //}

    /**
     * Fund transfer into futures account.
     *
     * @param string $amount
     * @param string $currency
     * @param string $payAccountType
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function transferInV2($amount, $currency, $payAccountType)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/transfer-in', compact('amount', 'currency', 'payAccountType'));
        return $response->getApiData();
    }

    /**
     * Query Funding Fee Settlement History
     *
     * @param array $params
     * @param array $pagination
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2FundingHistory(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/funding-history', $params + $pagination);
        return $response->getApiData();
    }
    ///**
    // * Transfer between Master user and Sub-user
    // *
    // * @param array $params
    // * @return mixed|null
    // * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
    // * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
    // * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
    // */
    //public function subTransfer(array $params)
    //{
    //    $response = $this->call(Request::METHOD_POST, 'api/v2/sub-transfer', $params);
    //    return $response->getApiData();
    //}
}