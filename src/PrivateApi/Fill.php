<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Fill
 * @package KuCoin\Futures\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#fills
 */
class Fill extends KuCoinFuturesApi
{
    /**
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getHistoricalTrades instead
     *
     * Get fills orders list.
     *
     */
    public function getFills(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/fills', $params + $pagination);
        return $response->getApiData();
    }

    /**
     *
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getHistoricalTrades instead
     *
     * Get the recent orders of the latest transactions within 24 hours.
     *
     */
    public function getRecentList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/recentFills');
        return $response->getApiData();
    }

    /**
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2FundingHistory instead
     *
     * Get a funding-history list.
     *
     */
    public function getFundingHistory(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/funding-history', $params + $pagination);
        return $response->getApiData();
    }

}
