<?php

namespace KuCoin\Futures\SDK\Tests\V2\PublicApi;

use KuCoin\Futures\SDK\PublicApi\V2\Symbol;
use KuCoin\Futures\SDK\Tests\TestCase;

class SymbolTest extends TestCase
{
    protected $apiClass = Symbol::class;

    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     *
     * @param Symbol $symbol
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2OrderBook(Symbol $symbol)
    {
        $data = $symbol->getV2OrderBook('SHIBUSDTM', 10);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('contractId', $data);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('ts', $data);
        $this->assertArrayHasKey('sequence', $data);
        $this->assertArrayHasKey('asks', $data);
        $this->assertArrayHasKey('bids', $data);
        $this->assertInternalType('array', $data['bids']);
        $this->assertInternalType('array', $data['asks']);

        foreach ($data['bids'] as $datum) {
            $this->assertInternalType('array', $datum);
            $this->assertCount(2, $datum);
        }

        foreach ($data['asks'] as $datum) {
            $this->assertInternalType('array', $datum);
            $this->assertCount(2, $datum);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Symbol $symbol
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2Ticker(Symbol $symbol)
    {
        $data = $symbol->getV2Ticker('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('askPrice', $data);
        $this->assertArrayHasKey('bidPrice', $data);
        $this->assertArrayHasKey('askSize', $data);
        $this->assertArrayHasKey('bidSize', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Symbol $symbol
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2TickerPrice(Symbol $symbol)
    {
        $data = $symbol->getV2TickerPrice('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('ts', $data);
        $this->assertArrayHasKey('price', $data);
        $this->assertArrayHasKey('symbol', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Symbol $symbol
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2TradeHistory(Symbol $symbol)
    {
        $data = $symbol->getV2TradeHistory('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertArrayHasKey('matchSide', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('ts', $item);
        }
    }
}