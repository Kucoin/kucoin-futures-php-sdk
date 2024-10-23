<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PrivateApi\Position;

class PositionTest extends TestCase
{
    protected $apiClass    = Position::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Position $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Position $api)
    {
        $data = $api->getList();
//        $this->assertPagination($data);
        foreach ($data as $item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('autoDeposit', $item);
            $this->assertArrayHasKey('maintMarginReq', $item);
            $this->assertArrayHasKey('riskLimit', $item);
            $this->assertArrayHasKey('realLeverage', $item);
            $this->assertArrayHasKey('crossMode', $item);
            $this->assertArrayHasKey('delevPercentage', $item);
//            $this->assertArrayHasKey('openingTimestamp', $item);
            $this->assertArrayHasKey('currentTimestamp', $item);
            $this->assertArrayHasKey('currentQty', $item);
            $this->assertArrayHasKey('currentCost', $item);
            $this->assertArrayHasKey('currentComm', $item);
            $this->assertArrayHasKey('unrealisedCost', $item);
            $this->assertArrayHasKey('realisedGrossCost', $item);
            $this->assertArrayHasKey('realisedCost', $item);
            $this->assertArrayHasKey('isOpen', $item);
            $this->assertArrayHasKey('markPrice', $item);
            $this->assertArrayHasKey('markValue', $item);
            $this->assertArrayHasKey('posCost', $item);
            $this->assertArrayHasKey('posCross', $item);
            $this->assertArrayHasKey('posInit', $item);
            $this->assertArrayHasKey('posComm', $item);
            $this->assertArrayHasKey('posLoss', $item);
            $this->assertArrayHasKey('posMargin', $item);
            $this->assertArrayHasKey('posMaint', $item);
            $this->assertArrayHasKey('maintMargin', $item);
            $this->assertArrayHasKey('realisedGrossPnl', $item);
            $this->assertArrayHasKey('realisedPnl', $item);
            $this->assertArrayHasKey('unrealisedPnl', $item);
            $this->assertArrayHasKey('unrealisedPnlPcnt', $item);
            $this->assertArrayHasKey('avgEntryPrice', $item);
            $this->assertArrayHasKey('liquidationPrice', $item);
            $this->assertArrayHasKey('bankruptPrice', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Position $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetDetail(Position $api)
    {
        $item = $api->getDetail("XBTUSDM");
        $this->assertArrayHasKey('id', $item);
        $this->assertArrayHasKey('symbol', $item);
        $this->assertArrayHasKey('autoDeposit', $item);
        $this->assertArrayHasKey('maintMarginReq', $item);
        $this->assertArrayHasKey('riskLimit', $item);
        $this->assertArrayHasKey('realLeverage', $item);
        $this->assertArrayHasKey('crossMode', $item);
        $this->assertArrayHasKey('delevPercentage', $item);
        $this->assertArrayHasKey('openingTimestamp', $item);
        $this->assertArrayHasKey('currentTimestamp', $item);
        $this->assertArrayHasKey('currentQty', $item);
        $this->assertArrayHasKey('currentCost', $item);
        $this->assertArrayHasKey('currentComm', $item);
        $this->assertArrayHasKey('unrealisedCost', $item);
        $this->assertArrayHasKey('realisedGrossCost', $item);
        $this->assertArrayHasKey('realisedCost', $item);
        $this->assertArrayHasKey('isOpen', $item);
        $this->assertArrayHasKey('markPrice', $item);
        $this->assertArrayHasKey('markValue', $item);
        $this->assertArrayHasKey('posCost', $item);
        $this->assertArrayHasKey('posCross', $item);
        $this->assertArrayHasKey('posInit', $item);
        $this->assertArrayHasKey('posComm', $item);
        $this->assertArrayHasKey('posLoss', $item);
        $this->assertArrayHasKey('posMargin', $item);
        $this->assertArrayHasKey('posMaint', $item);
        $this->assertArrayHasKey('maintMargin', $item);
        $this->assertArrayHasKey('realisedGrossPnl', $item);
        $this->assertArrayHasKey('realisedPnl', $item);
        $this->assertArrayHasKey('unrealisedPnl', $item);
        $this->assertArrayHasKey('unrealisedPnlPcnt', $item);
        $this->assertArrayHasKey('avgEntryPrice', $item);
        $this->assertArrayHasKey('liquidationPrice', $item);
        $this->assertArrayHasKey('bankruptPrice', $item);
    }

    /**
     * @dataProvider apiProvider
     * @param Position $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testChangeAutoAppendStatus(Position $api)
    {
        $data = $api->changeAutoAppendStatus('XBTUSDM', true);
//        $this->assertInternalType('array', $data);
        $this->assertNull($data);
    }

    /**
     * @dataProvider apiProvider
     * @param Position $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testMarginAppend(Position $api)
    {
        $params = [
            'symbol' => 'XBTUSDM',
            'margin' => 1000,
            'bizNo'  => '123123',
        ];
        $data = $api->marginAppend($params);
//        $this->assertInternalType('array', $data);
        $this->assertNull($data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Position $api
     * @return void
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetMaxWithdrawMargin(Position $api)
    {
        $symbol = 'XBTUSDM';
        $result = $api->getMaxWithdrawMargin($symbol);
        $this->assertGreaterThanOrEqual('0', $result);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Position $api
     * @return void
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testWithdrawMargin(Position $api)
    {
        $symbol = 'XBTUSDTM';
        $result = $api->withdrawMargin($symbol, '0.1');
        $this->assertEquals('0.1', $result);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Position $api
     * @return void
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetGetHistoryPositions(Position $api)
    {
        $params = [
            'limit'  => 2,
            'pageId' => 1,
        ];
        $result = $api->getHistoryPositions($params);
        $this->assertPagination($result);
        foreach ($result['items'] as $item) {
            $this->assertArrayHasKey('closeId', $item);
            $this->assertArrayHasKey('userId', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('settleCurrency', $item);
            $this->assertArrayHasKey('leverage', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('pnl', $item);
            $this->assertArrayHasKey('realisedGrossCost', $item);
            $this->assertArrayHasKey('withdrawPnl', $item);
            $this->assertArrayHasKey('tradeFee', $item);
            $this->assertArrayHasKey('fundingFee', $item);
            $this->assertArrayHasKey('openTime', $item);
            $this->assertArrayHasKey('closeTime', $item);
            $this->assertArrayHasKey('openPrice', $item);
            $this->assertArrayHasKey('closePrice', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Position $api
     * @return void
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetMaxOpenSize(Position $api)
    {
        $symbol = 'XBTUSDTM';
        $price = '60000';
        $leverage = 2;
        $result = $api->getMaxOpenSize($symbol, $price, $leverage);
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('symbol', $result);
        $this->assertArrayHasKey('maxBuyOpenSize', $result);
        $this->assertArrayHasKey('maxSellOpenSize', $result);
    }
}
