<?php

namespace KuMEX\SDK\PrivateApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Withdrawal
 * @package KuMEX\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#withdrawal
 */
class Withdrawal extends KuMEXApi
{
    /**
     * Get withdraw quotas
     * @param string $currency
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getQuotas($currency)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/withdrawals/quotas', compact('currency'));
        return $response->getApiData();
    }

    /**
     * Get a list of withdrawal
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getList(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/withdrawal-list', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Apply a withdrawal
     * @param array $params
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function apply(array $params)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/withdrawals', $params);
        return $response->getApiData();
    }

    /**
     * Cancel a withdrawal
     * @param string $withdrawId
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function cancel($withdrawId)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/withdrawals/' . $withdrawId);
        return $response->getApiData();
    }
}
