<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Order
 * @package KuCoin\Futures\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#orders
 */
class Order extends KuCoinFuturesApi
{
    /**
     * @param array $order
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated  V2.0 use createV2 instead
     *
     * Place a new order.
     *
     */
    public function create(array $order)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/orders', $order);
        return $response->getApiData();
    }

    /**
     * @param string $orderId
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use cancelV2 instead
     *
     * Cancel an order.
     *
     */
    public function cancel($orderId)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/orders/' . $orderId);
        return $response->getApiData();
    }

    /**
     * @param string|null $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use batchV2Cancel instead
     *
     * Batch cancel orders.
     *
     */
    public function batchCancel($symbol = null)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/orders', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * @param string|null $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use batchV2Cancel instead
     *
     * Batch cancel stop orders.
     *
     */
    public function stopOrders($symbol = null)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/stopOrders', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2List instead
     *
     * List orders.
     *
     */
    public function getList(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/orders', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getAllActiveOrders instead
     *
     * Stop orders list.
     *
     */
    public function getStopOrders(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/stopOrders', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * 24 hour done of orders.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getRecentDoneOrders(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/recentDoneOrders', $params + $pagination);
        return $response->getApiData();
    }

    /**
     *
     * @param string $orderId
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2Detail instead
     *
     * Get an order.
     *
     */
    public function getDetail($orderId)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/orders/' . $orderId, []);
        return $response->getApiData();
    }

    /**
     * @param string|null $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getHistoricalTrades instead
     *
     * Get open order statistics.
     *
     */
    public function getOpenOrderStatistics($symbol = null)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/openOrderStatistics', compact('symbol'));
        return $response->getApiData();
    }
}
