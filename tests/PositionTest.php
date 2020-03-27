<?php

namespace KuMEX\SDK\Tests;

use KuMEX\SDK\PrivateApi\Position;

class PositionTest extends TestCase
{
    protected $apiClass    = Position::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Position $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testMarginAppend(Position $api)
    {
        $params = [
            'symbol' => 'XBTUSDM',
            'margin' => 1000,
            'bizNo' =>  '123123'
        ];
        $data = $api->marginAppend($params);
//        $this->assertInternalType('array', $data);
        $this->assertNull($data);
    }

}
