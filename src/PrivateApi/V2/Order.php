<?php

namespace KuCoin\Futures\SDK\PrivateApi\V2;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Order
 * @package KuCoin\Futures\SDK\PrivateApi\V2
 *
 * @see https://docs.kucoin.com/futures/new/#order
 */
class Order extends KuCoinFuturesApi
{
    /**
     * Order placement.
     *
     * @param array $order
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function createV2(array $order)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/order', $order);
        return $response->getApiData();
    }

    /**
     * Single Order Cancellation.
     *
     * @param string $symbol
     * @param string $orderId
     * @param string $clientOId
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function cancelV2($symbol, $orderId = null, $clientOId = null)
    {
        $params = compact('symbol', 'orderId', 'clientOId');
        $response = $this->call(Request::METHOD_DELETE, '/api/v2/order', array_filter($params));
        return $response->getApiData();
    }

    /**
     * Batch Order Cancellation.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function batchV2Cancel($symbol)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v2/orders', ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Query Transaction Records.
     *
     * @param $symbol
     * @param array $params
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2HistoricalTrades($symbol, array $params = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/orders/historical-trades', array_merge($params, ['symbol' => $symbol]));
        return $response->getApiData();
    }

    /**
     * Query Individual Order’s Details.
     *
     * @param null $orderId
     * @param null $clientId
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Detail($orderId = null, $clientId = null)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/order/detail', array_filter(compact('orderId', 'clientId')));
        return $response->getApiData();
    }

    /**
     * Query Active Orders.
     *
     * @param string $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2ActiveOrders($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/orders/active', ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Query All Active Orders.
     *
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2AllActiveOrders()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/orders/all-active');
        return $response->getApiData();
    }

    /**
     * Query Historical Orders.
     *
     * @param array $params
     * @param array $pagination
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2List(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/orders/history', $params + $pagination);
        return $response->getApiData();
    }
}