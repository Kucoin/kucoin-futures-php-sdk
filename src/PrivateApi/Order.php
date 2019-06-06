<?php

namespace KuMex\SDK\PrivateApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Order
 * @package KuMex\SDK\PrivateApi
 * @see https://docs.KuMex.com/#orders
 */
class Order extends KuMexApi
{
    /**
     * Place a new order.
     *
     * @param  array $order
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function create(array $order)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/orders', $order);
        return $response->getApiData();
    }

    /**
     * Cancel an order.
     *
     * @param  string $orderId
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function cancel($orderId)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/orders/' . $orderId);
        return $response->getApiData();
    }

    /**
     * Batch cancel orders.
     *
     * @param  string|null $symbol
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function batchCancel($symbol = null)
    {
        $response = $this->call(Request::METHOD_DELETE, '/api/v1/orders', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Batch cancel stop orders.
     *
     * @param  string|null $symbol
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getRecentDoneOrders(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/recentDoneOrders', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Get an order.
     *
     * @param  string $orderId
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetail($orderId)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/orders/' . $orderId, []);
        return $response->getApiData();
    }

    /**
     * Get open order statistics.
     *
     * @param  string|null $symbol
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getOpenOrderStatistics($symbol = null)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/openOrderStatistics', $symbol);
        return $response->getApiData();
    }
}
