<?php

namespace KuMex\SDK\Tests;

use KuMex\SDK\PrivateApi\Order;

class OrderTest extends TestCase
{
    protected $apiClass    = Order::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @return array|string
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testCreateLimit(Order $api)
    {
        $order = [
            'clientOid' => uniqid(),
            'type'      => 'limit',
            'side'      => 'buy',
            'symbol'    => 'XBTUSDM',
            'leverage'  => 2,
            'remark'    => '\中文备注 ',

            'price' => 100,
            'size'  => 1,
        ];
        $data = $api->create($order);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('orderId', $data);
    }

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @return array|string
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testCreateMarket(Order $api)
    {
        $order = [
            'clientOid' => uniqid(),
            'type'      => 'market',
            'side'      => 'buy',
            'symbol'    => 'XBTUSDM',
            'leverage'  => 2,
            'remark'    => 'Test Order ' . time(),

            'size'      => 1,
        ];
        $data = $api->create($order);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('orderId', $data);
    }

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Order $api)
    {
        $data = $api->getList(['symbol' => 'XBTUSDM'], ['currentPage' => 1, 'pageSize' => 10]);
        $this->assertPagination($data);
        foreach ($data['items'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('hidden', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('iceberg', $item);
            $this->assertArrayHasKey('createdAt', $item);
            $this->assertArrayHasKey('stopTriggered', $item);
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('timeInForce', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('dealSize', $item);
            $this->assertArrayHasKey('stp', $item);
            $this->assertArrayHasKey('postOnly', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('stop', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetDetail(Order $api)
    {
        $data = $api->getList(['symbol' => 'XBTUSDM'], ['currentPage' => 1, 'pageSize' => 10]);
        $this->assertPagination($data);
        $orders = $data['items'];
        if (isset($orders[0])) {
            $order = $api->getDetail($orders[0]['id']);
            $this->assertArrayHasKey('symbol', $order);
            $this->assertArrayHasKey('hidden', $order);
            $this->assertArrayHasKey('type', $order);
            $this->assertArrayHasKey('iceberg', $order);
            $this->assertArrayHasKey('createdAt', $order);
            $this->assertArrayHasKey('stopTriggered', $order);
            $this->assertArrayHasKey('id', $order);
            $this->assertArrayHasKey('timeInForce', $order);
            $this->assertArrayHasKey('side', $order);
            $this->assertArrayHasKey('dealSize', $order);
            $this->assertArrayHasKey('stp', $order);
            $this->assertArrayHasKey('postOnly', $order);
            $this->assertArrayHasKey('size', $order);
            $this->assertArrayHasKey('stop', $order);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testCancel($api)
    {
        $result = $api->cancel($this->getOrderId($api));
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('cancelledOrderIds', $result);
    }

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testBatchCancel($api)
    {
        $result = $api->batchCancel('XBTUSDM');
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('cancelledOrderIds', $result);
    }

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetRecentList(Order $api)
    {
        $items = $api->getRecentDoneOrders();
        foreach ($items as $order) {
            $this->assertArrayHasKey('symbol', $order);
            $this->assertArrayHasKey('hidden', $order);
            $this->assertArrayHasKey('type', $order);
            $this->assertArrayHasKey('iceberg', $order);
            $this->assertArrayHasKey('createdAt', $order);
            $this->assertArrayHasKey('stopTriggered', $order);
            $this->assertArrayHasKey('id', $order);
            $this->assertArrayHasKey('timeInForce', $order);
            $this->assertArrayHasKey('side', $order);
            $this->assertArrayHasKey('dealSize', $order);
            $this->assertArrayHasKey('stp', $order);
            $this->assertArrayHasKey('postOnly', $order);
            $this->assertArrayHasKey('size', $order);
            $this->assertArrayHasKey('stop', $order);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Order $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testOpenOrderStatistics($api)
    {
        $result = $api->getOpenOrderStatistics('XBTUSD');
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('openOrderBuySize', $result);
        $this->assertArrayHasKey('openOrderSellSize', $result);
        $this->assertArrayHasKey('openOrderBuyCost', $result);
        $this->assertArrayHasKey('openOrderSellCost', $result);
    }

    /**
     * @dataProvider apiProvider.
     *
     * @param Order $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    private function getOrderId($api)
    {
        $order = [
            'clientOid' => uniqid(),
            'type'      => 'limit',
            'side'      => 'buy',
            'symbol'    => 'XBTUSDM',
            'leverage'  => 2,
            'remark'    => '\中文备注 ',

            'price' => 100,
            'size'  => 1,
        ];
        $data = $api->create($order);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('orderId', $data);
        return $data['orderId'];
    }
}
