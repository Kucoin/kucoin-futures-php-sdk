<?php

namespace KuCoin\Futures\SDK\PublicApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Contract
 * @package KuCoin\Futures\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#get-open-contract-list
 */
class Contract extends KuCoinFuturesApi
{
    /**
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2List instead
     *
     * Get a list of contract.
     *
     */
    public function getList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/contracts/active');
        return $response->getApiData();
    }

    /**
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2List instead
     *
     * Get the details of a contract.
     *
     */
    public function getDetail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/contracts/' . $symbol);
        return $response->getApiData();
    }
}
