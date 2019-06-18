<?php
/**
 * Author: <easy> easy@kucoin.com
 * Date: 2019/6/17 下午3:08
 */

namespace KuMex\SDK\Tests;

use \KuMex\SDK\PublicApi\Index;


class IndexTest extends TestCase
{

    protected $apiClass    = Index::class;
    protected $apiWithAuth = false;

    /**
     *
     * @dataProvider apiProvider
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Index $api)
    {
        $params  =  [
            'symbol' => '.BXBT'
        ];
        $data = $api->getList($params);
        $this->assertInternalType('array', $data);
        foreach ($data['dataList'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('granularity', $item);
            $this->assertArrayHasKey('timePoint', $item);
            $this->assertArrayHasKey('value', $item);
            $this->assertArrayHasKey('decomposionList', $item);
        }
    }

    /**
     *
     * @dataProvider apiProvider
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetInterests(Index $api)
    {
        $params  =  [
            'symbol' => '.BXBT'
        ];
        $data = $api->getInterests($params);
        $this->assertInternalType('array', $data);
        foreach ($data['dataList'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('granularity', $item);
            $this->assertArrayHasKey('timePoint', $item);
            $this->assertArrayHasKey('value', $item);
        }
    }

    /**
     *
     * @dataProvider apiProvider
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetMarkPrice(Index $api)
    {
        $data = $api->getMarkPrice('XBTUSDM');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('granularity', $data);
        $this->assertArrayHasKey('timePoint', $data);
        $this->assertArrayHasKey('value', $data);
        $this->assertArrayHasKey('indexPrice', $data);
    }

    /**
     *
     * @dataProvider apiProvider
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetPremium(Index $api)
    {
        $params  =  [
            'symbol' => '.BXBT'
        ];
        $data = $api->getPremium($params);
        $this->assertInternalType('array', $data);
        foreach ($data['dataList'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('granularity', $item);
            $this->assertArrayHasKey('timePoint', $item);
            $this->assertArrayHasKey('value', $item);
        }
    }

    /**
     *
     * @dataProvider apiProvider
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetCurrentFundingRate(Index $api)
    {
        $data = $api->getCurrentFundingRate('.XBTUSDFPI8H');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('granularity', $data);
        $this->assertArrayHasKey('timePoint', $data);
        $this->assertArrayHasKey('value', $data);
        $this->assertArrayHasKey('predictedValue', $data);
    }

    /**
     *
     * @dataProvider apiProvider
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetFundingHistory(Index $api)
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
        }
    }

}