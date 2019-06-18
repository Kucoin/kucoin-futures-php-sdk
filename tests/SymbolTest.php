<?php

namespace KuMex\SDK\Tests;

use KuMex\SDK\PublicApi\Symbol;

class SymbolTest extends TestCase
{

    protected $apiClass    = Symbol::class;
    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     * @param Symbol $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetTicker(Symbol $api)
    {
        $data = $api->getTicker('XBTUSDM');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('sequence', $data);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('size', $data);
        $this->assertArrayHasKey('price', $data);
        $this->assertArrayHasKey('bestBid', $data);
        $this->assertArrayHasKey('bestBidSize', $data);
        $this->assertArrayHasKey('bestAsk', $data);
        $this->assertArrayHasKey('bestAskSize', $data);
        $this->assertArrayHasKey('ts', $data);
    }

    /**
     * @dataProvider apiProvider
     * @param Symbol $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetLevel2Snapshot(Symbol $api)
    {
        $data = $api->getLevel2Snapshot('XBTUSDM');
        $this->assertInternalType('array', $data);
        foreach ($data['data'] as $item) {
            $this->assertArrayHasKey('sequence', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('change', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Symbol $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetLevel3Snapshot(Symbol $api)
    {
        $data = $api->getLevel3Snapshot('XBTUSDM');
        $this->assertInternalType('array', $data);
        $item = $data['data'];
        $this->assertArrayHasKey('symbol', $item);
        $this->assertArrayHasKey('sequence', $item);
        $this->assertArrayHasKey('bids', $item);
        $this->assertArrayHasKey('asks', $item);
    }

    /**
     * @dataProvider apiProvider
     * @param Symbol $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetLevel2Message(Symbol $api)
    {
        $data = $api->getLevel2Message('XBTUSDM', 1, 100);
        $this->assertInternalType('array', $data);
        foreach ($data['data'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('sequence', $item);
            $this->assertArrayHasKey('orderId', $item);
            $this->assertArrayHasKey('type', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Symbol $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetLevel3Message(Symbol $api)
    {
        $data = $api->getLevel2Message('XBTUSDM', 1, 100);
        $this->assertInternalType('array', $data);
        foreach ($data['data'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('sequence', $item);
            $this->assertArrayHasKey('orderId', $item);
            $this->assertArrayHasKey('type', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Symbol $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetTradeHistory(Symbol $api)
    {
        $data = $api->getLevel3Snapshot('XBTUSDM');
        $this->assertInternalType('array', $data);
        $item = $data['data'];
        $this->assertArrayHasKey('sequence', $item);
        $this->assertArrayHasKey('tradeId', $item);
        $this->assertArrayHasKey('takerOrderId', $item);
        $this->assertArrayHasKey('makerOrderId', $item);
        $this->assertArrayHasKey('price', $item);
    }

}