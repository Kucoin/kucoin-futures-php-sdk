<?php

namespace KuMEX\SDK\Tests;

use KuMEX\SDK\PrivateApi\Fill;

class FillTest extends TestCase
{
    protected $apiClass    = Fill::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Fill $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Fill $api)
    {
        $data = $api->getFills([], ['currentPage' => 1, 'pageSize' => 10]);
        var_dump($data);
        $this->assertPagination($data);
        foreach ($data['items'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('forceTaker', $item);
            $this->assertArrayHasKey('orderId', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('liquidity', $item);
            $this->assertArrayHasKey('feeRate', $item);
            $this->assertArrayHasKey('createdAt', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('stop', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertArrayHasKey('tradeId', $item);
            $this->assertArrayHasKey('settleCurrency', $item);
            $this->assertArrayHasKey('tradeTime', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Fill $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetRecentList(Fill $api)
    {
        $items = $api->getRecentList();
        $this->assertInternalType('array', $items);
        foreach ($items as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('forceTaker', $item);
            $this->assertArrayHasKey('orderId', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('liquidity', $item);
            $this->assertArrayHasKey('feeRate', $item);
            $this->assertArrayHasKey('createdAt', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('stop', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertArrayHasKey('tradeId', $item);
            $this->assertArrayHasKey('settleCurrency', $item);
            $this->assertArrayHasKey('tradeTime', $item);
        }
    }


    /**
     *
     * @dataProvider apiProvider
     * @param Fill $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetFundingHistory(Fill $api)
    {
        $params  =  [
            'symbol' => 'XBTUSDM'
        ];
        $data = $api->getFundingHistory($params);
        $this->assertInternalType('array', $data);
        foreach ($data['dataList'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('fundingRate', $item);
            $this->assertArrayHasKey('timePoint', $item);
            $this->assertArrayHasKey('markPrice', $item);
            $this->assertArrayHasKey('positionQty', $item);
            $this->assertArrayHasKey('positionCost', $item);
            $this->assertArrayHasKey('funding', $item);
            $this->assertArrayHasKey('settleCurrency', $item);
        }
    }
}