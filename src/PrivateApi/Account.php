<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Account
 * @package KuCoin\Futures\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#account
 */
class Account extends KuCoinFuturesApi
{
    /**
     * Get an account overview.
     *
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getOverview(array $params = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/account-overview', $params);
        return $response->getApiData();
    }

    /**
     * Get a transaction history of accounts.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getTransactionHistory(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/transaction-history', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * KuCoin transfer to kuCoin futures account.
     * @param string amount
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function transferIn($amount)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/transfer-in', compact('amount'));
        return $response->getApiData();
    }

    /**
     * kuCoin futures transfer to KuCoin account.
     *
     * @param string bizNo
     * @param string amount
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function transferOut($bizNo, $amount)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/transfer-out', compact('bizNo', 'amount'));
        return $response->getApiData();
    }

    /**
     * Cancel an transfer out.
     * @param string $applyId
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated
     */
    public function cancelTransferOut($applyId)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/cancel/transfer-out?applyId=' . $applyId);
        return $response->getApiData();
    }

    /**
     * Get a transfer list.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getTransferList(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/transfer-list', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * kuCoin futures transfer to KuCoin account.
     * [It is recommended to use POST /api/v3/transfer-out instead]
     * @param string bizNo
     * @param string amount
     * @param string currency
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function transferOutV2($bizNo, $amount, $currency)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/transfer-out', compact('bizNo', 'amount', 'currency'));
        return $response->getApiData();
    }

    /**
     * Get list of Futures APIs pertaining to a sub-accounts.
     *
     * @param array $params
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getSubApikey(array $params)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/sub/api-key', $params);
        return $response->getApiData();
    }

    /**
     * Create futures APIs for sub-accounts.
     *
     * @param array $params
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function createSubApikey(array $params)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/sub/api-key', $params);
        return $response->getApiData();
    }

    /**
     * Modify futures APIs for sub-accounts.
     *
     * @param array $params
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function modifySubApikey(array $params)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/sub/api-key/update', $params);
        return $response->getApiData();
    }

    /**
     * Delete futures APIs for sub-accounts.
     *
     * @param array $params
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function deleteSubApikey(array $params)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/sub/api-key', $params);
        return $response->getApiData();
    }

    /**
     * kuCoin futures transfer to KuCoin account.
     *
     * @param string recAccountType
     * @param string amount
     * @param string currency
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function transferOutV3($recAccountType, $amount, $currency)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v3/transfer-out', compact('recAccountType', 'amount', 'currency'));
        return $response->getApiData();
    }
}
