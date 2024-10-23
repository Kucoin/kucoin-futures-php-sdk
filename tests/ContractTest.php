<?php
/**
 * Author: <easy> easy@kucoin.com
 * Date: 2019/6/17 下午3:08
 */

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PublicApi\Contract;


class ContractTest extends TestCase
{

    protected $apiClass    = Contract::class;
    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     * @param Contract $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Contract $api)
    {
        $data = $api->getList();
        $this->assertInternalType('array', $data);

        foreach ($data as $item) {
            $this->assertInternalType('array', $item);

            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('rootSymbol', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('firstOpenDate', $item);
            $this->assertArrayHasKey('expireDate', $item);
            $this->assertArrayHasKey('settleDate', $item);
            $this->assertArrayHasKey('baseCurrency', $item);
            $this->assertArrayHasKey('quoteCurrency', $item);
            $this->assertArrayHasKey('settleCurrency', $item);
            $this->assertArrayHasKey('maxOrderQty', $item);
            $this->assertArrayHasKey('maxPrice', $item);
            $this->assertArrayHasKey('lotSize', $item);
            $this->assertArrayHasKey('tickSize', $item);
            $this->assertArrayHasKey('indexPriceTickSize', $item);
            $this->assertArrayHasKey('multiplier', $item);
            $this->assertArrayHasKey('initialMargin', $item);
            $this->assertArrayHasKey('maintainMargin', $item);
            $this->assertArrayHasKey('maxRiskLimit', $item);
            $this->assertArrayHasKey('minRiskLimit', $item);
            $this->assertArrayHasKey('riskStep', $item);
            $this->assertArrayHasKey('makerFeeRate', $item);
            $this->assertArrayHasKey('takerFeeRate', $item);
            $this->assertArrayHasKey('takerFixFee', $item);
            $this->assertArrayHasKey('makerFixFee', $item);
            $this->assertArrayHasKey('settlementFee', $item);
            $this->assertArrayHasKey('isDeleverage', $item);
            $this->assertArrayHasKey('isQuanto', $item);
            $this->assertArrayHasKey('isInverse', $item);
            $this->assertArrayHasKey('markMethod', $item);
            $this->assertArrayHasKey('fairMethod', $item);
            $this->assertArrayHasKey('fundingBaseSymbol', $item);
            $this->assertArrayHasKey('fundingQuoteSymbol', $item);
            $this->assertArrayHasKey('fundingRateSymbol', $item);
            $this->assertArrayHasKey('indexSymbol', $item);
            $this->assertArrayHasKey('settlementSymbol', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('fundingFeeRate', $item);
            $this->assertArrayHasKey('predictedFundingFeeRate', $item);
            $this->assertArrayHasKey('openInterest', $item);
            $this->assertArrayHasKey('turnoverOf24h', $item);
            $this->assertArrayHasKey('volumeOf24h', $item);
            $this->assertArrayHasKey('markPrice', $item);
            $this->assertArrayHasKey('indexPrice', $item);
            $this->assertArrayHasKey('lastTradePrice', $item);
            $this->assertArrayHasKey('nextFundingRateTime', $item);
            $this->assertArrayHasKey('maxLeverage', $item);
            $this->assertArrayHasKey('lowPrice', $item);
            $this->assertArrayHasKey('highPrice', $item);
            $this->assertArrayHasKey('priceChgPct', $item);
            $this->assertArrayHasKey('priceChg', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Contract $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetDetail(Contract $api)
    {
        $data = $api->getDetail('XBTUSDM');
        $this->assertInternalType('array', $data);

        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('rootSymbol', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('firstOpenDate', $data);
        $this->assertArrayHasKey('expireDate', $data);
        $this->assertArrayHasKey('settleDate', $data);
        $this->assertArrayHasKey('baseCurrency', $data);
        $this->assertArrayHasKey('quoteCurrency', $data);
        $this->assertArrayHasKey('settleCurrency', $data);
        $this->assertArrayHasKey('maxOrderQty', $data);
        $this->assertArrayHasKey('maxPrice', $data);
        $this->assertArrayHasKey('lotSize', $data);
        $this->assertArrayHasKey('tickSize', $data);
        $this->assertArrayHasKey('indexPriceTickSize', $data);
        $this->assertArrayHasKey('multiplier', $data);
        $this->assertArrayHasKey('initialMargin', $data);
        $this->assertArrayHasKey('maintainMargin', $data);
        $this->assertArrayHasKey('maxRiskLimit', $data);
        $this->assertArrayHasKey('minRiskLimit', $data);
        $this->assertArrayHasKey('riskStep', $data);
        $this->assertArrayHasKey('makerFeeRate', $data);
        $this->assertArrayHasKey('takerFeeRate', $data);
        $this->assertArrayHasKey('takerFixFee', $data);
        $this->assertArrayHasKey('makerFixFee', $data);
        $this->assertArrayHasKey('settlementFee', $data);
        $this->assertArrayHasKey('isDeleverage', $data);
        $this->assertArrayHasKey('isQuanto', $data);
        $this->assertArrayHasKey('isInverse', $data);
        $this->assertArrayHasKey('markMethod', $data);
        $this->assertArrayHasKey('fairMethod', $data);
        $this->assertArrayHasKey('fundingBaseSymbol', $data);
        $this->assertArrayHasKey('fundingQuoteSymbol', $data);
        $this->assertArrayHasKey('fundingRateSymbol', $data);
        $this->assertArrayHasKey('indexSymbol', $data);
        $this->assertArrayHasKey('settlementSymbol', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('fundingFeeRate', $data);
        $this->assertArrayHasKey('predictedFundingFeeRate', $data);
        $this->assertArrayHasKey('openInterest', $data);
        $this->assertArrayHasKey('turnoverOf24h', $data);
        $this->assertArrayHasKey('volumeOf24h', $data);
        $this->assertArrayHasKey('markPrice', $data);
        $this->assertArrayHasKey('indexPrice', $data);
        $this->assertArrayHasKey('lastTradePrice', $data);
        $this->assertArrayHasKey('nextFundingRateTime', $data);
        $this->assertArrayHasKey('maxLeverage', $data);
        $this->assertArrayHasKey('lowPrice', $data);
        $this->assertArrayHasKey('highPrice', $data);
        $this->assertArrayHasKey('priceChgPct', $data);
        $this->assertArrayHasKey('priceChg', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Contract $api
     * @return void
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetAllTickers(Contract $api)
    {
        $data = $api->getAllTickers();
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('sequence', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('tradeId', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertArrayHasKey('bestBidPrice', $item);
            $this->assertArrayHasKey('bestBidSize', $item);
            $this->assertArrayHasKey('bestAskPrice', $item);
            $this->assertArrayHasKey('bestAskSize', $item);
            $this->assertArrayHasKey('ts', $item);
        }
    }
}