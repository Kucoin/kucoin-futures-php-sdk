<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Exceptions\BusinessException;
use KuCoin\Futures\SDK\Exceptions\HttpException;
use KuCoin\Futures\SDK\Exceptions\InvalidApiUriException;
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
     * Place a new order.
     *
     * @param array $order
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function create(array $order)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/orders', $order);
        return $response->getApiData();
    }

    /**
     * Cancel an order.
     *
     * @param string $orderId
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function cancel($orderId)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/orders/' . $orderId);
        return $response->getApiData();
    }

    /**
     * Batch cancel orders.
     *
     * @param string|null $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function batchCancel($symbol = null)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/orders', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Batch cancel stop orders.
     *
     * @param string|null $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function stopOrders($symbol = null)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/stopOrders', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * List orders.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getList(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/orders', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Stop orders list.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
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
     * Get an order.
     *
     * @param string $orderId
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetail($orderId)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/orders/' . $orderId, []);
        return $response->getApiData();
    }

    /**
     * Get open order statistics.
     *
     * @param string|null $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getOpenOrderStatistics($symbol = null)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/openOrderStatistics', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Get an order By ClientOid.
     *
     * @param $clientOid
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetailByClientOid($clientOid)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/orders/' . $clientOid, ['clientOid' => $clientOid]);
        return $response->getApiData();
    }

    /**
     * Cancel Order by clientOid.
     *
     * @param $clientOid
     * @param $symbol
     * @return array
     * @throws BusinessException
     * @throws HttpException
     * @throws InvalidApiUriException
     */
    public function cancelByClientOid($clientOid, $symbol)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/orders/client-order/' . $clientOid, ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Order test endpoint, the request parameters and return parameters of this endpoint are exactly the same as the order endpoint, and can be used to verify whether the signature is correct and other operations. After placing an order, the order will not enter the matching system, and the order cannot be queried.
     *
     * @param array $order
     * @return mixed|null
     * @throws BusinessException
     * @throws HttpException
     * @throws InvalidApiUriException
     */
    public function createTest(array $order)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/orders/test', $order);
        return $response->getApiData();
    }
}
