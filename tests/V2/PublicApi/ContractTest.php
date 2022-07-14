<?php

namespace KuCoin\Futures\SDK\Tests\V2\PublicApi;

use KuCoin\Futures\SDK\PublicApi\V2\Contract;
use KuCoin\Futures\SDK\Tests\TestCase;

class ContractTest extends TestCase
{
    protected $apiClass = Contract::class;

    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     *
     * @param Contract $contract
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2List(Contract $contract)
    {
        $data = $contract->getV2List();
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('firstOpenDate', $item);
            $this->assertArrayHasKey('settleDate', $item);
            $this->assertArrayHasKey('baseCurrency', $item);
            $this->assertArrayHasKey('quoteCurrency', $item);
            $this->assertArrayHasKey('maxOrderQty', $item);
            $this->assertArrayHasKey('maxPrice', $item);
            $this->assertArrayHasKey('lotSize', $item);
            $this->assertArrayHasKey('tickSize', $item);
            $this->assertArrayHasKey('multiplier', $item);
            $this->assertArrayHasKey('makerFeeRate', $item);
            $this->assertArrayHasKey('takerFeeRate', $item);
            $this->assertArrayHasKey('settlementFeeRate', $item);
            $this->assertArrayHasKey('isInverse', $item);
            $this->assertArrayHasKey('fundingBaseSymbol', $item);
            $this->assertArrayHasKey('fundingQuoteSymbol', $item);
            $this->assertArrayHasKey('fundingRateSymbol', $item);
            $this->assertArrayHasKey('indexSymbol', $item);
            $this->assertArrayHasKey('settlementSymbol', $item);
            $this->assertArrayHasKey('status', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Contract $contract
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2Detail(Contract $contract)
    {
        $data = $contract->getV2Detail('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('firstOpenDate', $data);
        $this->assertArrayHasKey('settleDate', $data);
        $this->assertArrayHasKey('baseCurrency', $data);
        $this->assertArrayHasKey('quoteCurrency', $data);
        $this->assertArrayHasKey('maxOrderQty', $data);
        $this->assertArrayHasKey('maxPrice', $data);
        $this->assertArrayHasKey('lotSize', $data);
        $this->assertArrayHasKey('tickSize', $data);
        $this->assertArrayHasKey('multiplier', $data);
        $this->assertArrayHasKey('makerFeeRate', $data);
        $this->assertArrayHasKey('takerFeeRate', $data);
        $this->assertArrayHasKey('settlementFeeRate', $data);
        $this->assertArrayHasKey('isInverse', $data);
        $this->assertArrayHasKey('fundingBaseSymbol', $data);
        $this->assertArrayHasKey('fundingQuoteSymbol', $data);
        $this->assertArrayHasKey('fundingRateSymbol', $data);
        $this->assertArrayHasKey('indexSymbol', $data);
        $this->assertArrayHasKey('settlementSymbol', $data);
        $this->assertArrayHasKey('status', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Contract $contract
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2RiskLimitLevel(Contract $contract)
    {
        $data = $contract->getV2RiskLimitLevel('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        foreach ($data as $datum) {
            $this->assertArrayHasKey('symbol', $datum);
            $this->assertArrayHasKey('level', $datum);
            $this->assertArrayHasKey('maxRiskLimit', $datum);
            $this->assertArrayHasKey('minRiskLimit', $datum);
            $this->assertArrayHasKey('maxLeverage', $datum);
            $this->assertArrayHasKey('initialMarginRate', $datum);
            $this->assertArrayHasKey('maintenanceMarginRate', $datum);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Contract $contract
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2KLines(Contract $contract)
    {
        $data = $contract->getV2KLines('SHIBUSDTM', null, null, 60);
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertCount(6, $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Contract $contract
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2FundingRate(Contract $contract)
    {
        $data = $contract->getV2FundingRate('SHIBUSDTM', []);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('hasMore', $data);
        $this->assertArrayHasKey('dataList', $data);
        foreach ($data['dataList'] as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('granularity', $item);
            $this->assertArrayHasKey('timePoint', $item);
            $this->assertArrayHasKey('value', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Contract $contract
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2MarkPrice(Contract $contract)
    {
        $data = $contract->getV2MarkPrice('SHIBUSDTM');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('indexPrice', $data);
        $this->assertArrayHasKey('timePoint', $data);
        $this->assertArrayHasKey('value', $data);
    }
}