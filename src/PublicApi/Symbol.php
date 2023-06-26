<?php

namespace KuCoin\Futures\SDK\PublicApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Symbol
 * @package KuCoin\Futures\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#symbol-2
 */
class Symbol extends KuCoinFuturesApi
{
    /**
     * Get the ticker details of a symbol.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getTicker($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/ticker', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Get the snapshot details of a symbol.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getLevel2Snapshot($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/level2/snapshot', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Get the snapshot details of a symbol.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getLevel3Snapshot($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/level3/snapshot', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Get the snapshot details of a symbol.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Level3Snapshot($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/level3/snapshot', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Get the level2 message of a symbol.
     *
     * @param string $symbol
     * @param int $start
     * @param int $end
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated
     */
    public function getLevel2Message($symbol, $start, $end)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/level2/message/query',
            compact('symbol', 'start', 'end')
        );
        return $response->getApiData();
    }

    /**
     * @param string $symbol
     * @param int $start
     * @param int $end
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated
     *
     * Get the level3 message of a symbol.
     *
     */
    public function getLevel3Message($symbol, $start, $end)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/level3/message/query',
            compact('symbol', 'start', 'end')
        );
        return $response->getApiData();
    }

    /**
     * Get the trade history details of a symbol.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getTradeHistory($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/trade/history', compact('symbol'));
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
    public function getKLines($symbol, $from, $to, $granularity)
    {
        $response = $this->call(
            Request::METHOD_GET,
            '/api/v1/kline/query',
            compact('symbol', 'from', 'to', 'granularity')
        );
        return $response->getApiData();
    }

    /**
     * Get the depth20 of level2.
     * @param string $symbol
     * @return mixed
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getLevel2Depth20($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/level2/depth20', ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Get the depth100 of level2.
     * @param string $symbol
     * @return mixed
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getLevel2Depth100($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/level2/depth100', ['symbol' => $symbol]);
        return $response->getApiData();
    }
}
