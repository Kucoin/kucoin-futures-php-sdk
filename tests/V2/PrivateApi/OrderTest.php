<?php

namespace KuCoin\Futures\SDK\Tests\V2\PrivateApi;

use KuCoin\Futures\SDK\PrivateApi\V2\Order;
use KuCoin\Futures\SDK\Tests\TestCase;

class OrderTest extends TestCase
{
    protected $apiClass = Order::class;

    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testCreateV2(Order $order)
    {
        $params = [
            'symbol'    => 'SHIBUSDTM',
            'side'      => 'BUY',
            'price'     => '0.00000558',
            'type'      => 'LIMIT',
            'size'      => '1',
            'clientOid' => uniqid('', true),
        ];

        $data = $order->createV2($params);
        $this->assertArrayHasKey('orderId', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testCancelV2(Order $order)
    {
        $params = [
            'symbol'    => 'SHIBUSDTM',
            'side'      => 'BUY',
            'price'     => '0.00000558',
            'type'      => 'LIMIT',
            'size'      => '2',
            'clientOid' => uniqid('', true),
        ];

        $ret = $order->createV2($params);
        $data = $order->cancelV2('SHIBUSDTM', $ret['orderId']);
        $this->assertArrayHasKey('orderId', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     *
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testBatchV2Cancel(Order $order)
    {
        $params = [
            'symbol'    => 'SHIBUSDTM',
            'side'      => 'BUY',
            'price'     => '0.00000558',
            'type'      => 'LIMIT',
            'size'      => '2',
            'clientOid' => uniqid('', true),
        ];

        $order->createV2($params);
        $data = $order->batchV2Cancel('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        $this->arrayHasKey('orderIds', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetHistoricalTrades(Order $order)
    {
        $data = $order->getHistoricalTrades('BTCUSDTM', ['startAt' => (time() - 86400) * 1000, 'endAt' => time() * 1000]);
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('orderId', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('time', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('feeRate', $item);
            $this->assertArrayHasKey('placeType', $item);
            $this->assertArrayHasKey('orderType', $item);
            $this->assertArrayHasKey('feeCurrency', $item);
            $this->assertArrayHasKey('pnl', $item);
            $this->assertArrayHasKey('pnlCurrency', $item);
            $this->assertArrayHasKey('value', $item);
            $this->assertArrayHasKey('maker', $item);
            $this->assertArrayHasKey('forceTaker', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2Detail(Order $order)
    {
        $params = [
            'symbol'    => 'SHIBUSDTM',
            'side'      => 'BUY',
            'price'     => '0.00000558',
            'type'      => 'LIMIT',
            'size'      => '1',
            'clientOid' => uniqid('', true),
        ];

        $ret = $order->createV2($params);
        $data = $order->getV2Detail($ret['orderId']);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('hidden', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('timeInForce', $data);
        $this->assertArrayHasKey('side', $data);
        $this->assertArrayHasKey('dealSize', $data);
        $this->assertArrayHasKey('postOnly', $data);
        $this->assertArrayHasKey('size', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('orderTime', $data);
    }


    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetActiveOrders(Order $order)
    {
        $data = $order->getActiveOrders('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('hidden', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('timeInForce', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('dealSize', $item);
            $this->assertArrayHasKey('postOnly', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('orderTime', $item);
            $this->assertArrayHasKey('clientOid', $item);
            $this->assertArrayHasKey('cancelSize', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetAllActiveOrders(Order $order)
    {
        $data = $order->getAllActiveOrders();
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('hidden', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('timeInForce', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('dealSize', $item);
            $this->assertArrayHasKey('postOnly', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('orderTime', $item);
            $this->assertArrayHasKey('clientOid', $item);
            $this->assertArrayHasKey('cancelSize', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Order $order
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2List(Order $order)
    {
        $data = $order->getV2List(['symbol' => 'BTCUSDTM', 'startAt' => (time() - 86400) * 1000, 'endAt' => time() * 1000]);
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('hidden', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('timeInForce', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('dealSize', $item);
            $this->assertArrayHasKey('postOnly', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('orderTime', $item);
            $this->assertArrayHasKey('clientOid', $item);
            $this->assertArrayHasKey('cancelSize', $item);
        }
    }
}