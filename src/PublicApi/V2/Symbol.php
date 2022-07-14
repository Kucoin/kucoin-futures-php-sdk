<?php

namespace KuCoin\Futures\SDK\PublicApi\V2;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

class Symbol extends KuCoinFuturesApi
{
    /**
     * Get Order Book.
     *
     * @param string $symbol
     * @param int $limit Order book depth, default 500, range 1 - 1000
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2OrderBook($symbol, $limit = 500)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/order-book', compact('symbol', 'limit'));
        return $response->getApiData();
    }

    /**
     * Best Maker.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Ticker($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/ticker/bookTicker', ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Get the latest transaction price.
     *
     * @param string $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2TickerPrice($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/ticker/price', ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Get Most Recent Record.
     *
     * @param string $symbol
     * @param int $limit
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2TradeHistory($symbol, $limit = 20)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/trades', ['symbol' => $symbol, 'limit' => $limit]);
        return $response->getApiData();
    }
}