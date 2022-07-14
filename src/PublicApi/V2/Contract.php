<?php

namespace KuCoin\Futures\SDK\PublicApi\V2;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Contract
 * @package KuCoin\Futures\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/new/#contract
 */
class Contract extends KuCoinFuturesApi
{
    /**
     * Get the information for all open contracts.
     *
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2List()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/contracts/active');
        return $response->getApiData();
    }

    /**
     * Get the details of a contract.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Detail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/contracts/' . $symbol);
        return $response->getApiData();
    }

    /**
     * Get Contract’s Risk Limit List.
     *
     * @param string $symbol
     *
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2RiskLimitLevel($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/contracts/risk-limit/' . $symbol);
        return $response->getApiData();
    }

    /**
     * Get KLines for a symbol. Data are returned in grouped buckets based on granularity.
     *
     * The granularity (granularity parameter of K-line) represents the number of minutes,
     * the available granularity scope is: 1,5,15,30,60,120,240,480,720,1440,10080.
     *
     * @param string $symbol
     * @param int $from
     * @param int $to
     * @param int $granularity
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2KLines($symbol, $from, $to, $granularity)
    {
        $response = $this->call(
            Request::METHOD_GET,
            '/api/v2/kline/query',
            compact('symbol', 'from', 'to', 'granularity')
        );
        return $response->getApiData();
    }

    /**
     * Query Funding Rate List.
     *
     * @param string $symbol
     * @param array $params
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2FundingRate($symbol, array $params)
    {
        $response = $this->call(Request::METHOD_GET, sprintf('/api/v2/contract/%s/funding-rates', $symbol), $params);
        return $response->getApiData();
    }

    /**
     * Get the Contract’s Mark price.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2MarkPrice($symbol)
    {
        $response = $this->call(Request::METHOD_GET, sprintf('/api/v2/mark-price/%s/current', $symbol));
        return $response->getApiData();
    }
}
