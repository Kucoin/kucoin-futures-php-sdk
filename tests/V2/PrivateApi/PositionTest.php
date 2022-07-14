<?php

namespace KuCoin\Futures\SDK\Tests\V2\PrivateApi;

use KuCoin\Futures\SDK\PrivateApi\V2\Position;
use KuCoin\Futures\SDK\Tests\TestCase;

class PositionTest extends TestCase
{
    protected $apiClass = Position::class;

    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     *
     * @param Position $position
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2List(Position $position)
    {
        $data = $position->getV2List();
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('qty', $item);
            $this->assertArrayHasKey('leverage', $item);
            $this->assertArrayHasKey('marginType', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('autoDeposit', $item);
            $this->assertArrayHasKey('entryPrice', $item);
            $this->assertArrayHasKey('entryValue', $item);
            $this->assertArrayHasKey('margin', $item);
            $this->assertArrayHasKey('totalMargin', $item);
            $this->assertArrayHasKey('liquidationPrice', $item);
            $this->assertArrayHasKey('unrealisedPnl', $item);
            $this->assertArrayHasKey('markPrice', $item);
            $this->assertArrayHasKey('riskRate', $item);
            $this->assertArrayHasKey('maintenanceMarginRate', $item);
            $this->assertArrayHasKey('maintenanceMargin', $item);
            $this->assertArrayHasKey('adlPercentile', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Position $position
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2Detail(Position $position)
    {
        $data = $position->getV2Detail('BTCUSDTM');
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('qty', $item);
            $this->assertArrayHasKey('leverage', $item);
            $this->assertArrayHasKey('marginType', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('autoDeposit', $item);
            $this->assertArrayHasKey('entryPrice', $item);
            $this->assertArrayHasKey('entryValue', $item);
            $this->assertArrayHasKey('margin', $item);
            $this->assertArrayHasKey('totalMargin', $item);
            $this->assertArrayHasKey('liquidationPrice', $item);
            $this->assertArrayHasKey('unrealisedPnl', $item);
            $this->assertArrayHasKey('markPrice', $item);
            $this->assertArrayHasKey('riskRate', $item);
            $this->assertArrayHasKey('maintenanceMarginRate', $item);
            $this->assertArrayHasKey('maintenanceMargin', $item);
            $this->assertArrayHasKey('adlPercentile', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Position $position
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testMarginV2Append(Position $position)
    {
        $params = [
            'symbol'       => 'BTCUSDTM',
            'positionSide' => 'BOTH',
            'amount'       => '10',
        ];

        $data = $position->marginV2Append($params);
        $this->assertTrue($data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Position $position
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetClosePnLHistory(Position $position)
    {
        $data = $position->getClosePnLHistory(['symbol' => 'SHIBUSDTM']);
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('settleCurrency', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('leverage', $item);
            $this->assertArrayHasKey('pnl', $item);
            $this->assertArrayHasKey('roe', $item);
            $this->assertArrayHasKey('openTime', $item);
            $this->assertArrayHasKey('closeTime', $item);
            $this->assertArrayHasKey('openPrice', $item);
            $this->assertArrayHasKey('closePrice', $item);
        }
    }
}