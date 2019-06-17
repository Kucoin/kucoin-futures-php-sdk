<?php

namespace KuMex\SDK\Tests;

use KuMex\SDK\PrivateApi\Fill;

class FillTest extends TestCase
{
    protected $apiClass    = Fill::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Fill $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Fill $api)
    {
        $data = $api->getFills([], ['currentPage' => 1, 'pageSize' => 10]);
        $this->assertPagination($data);
        foreach ($data['items'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('forceTaker', $item);
            $this->assertArrayHasKey('orderId', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('feeCurrency', $item);
            $this->assertArrayHasKey('liquidity', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('feeRate', $item);
            $this->assertArrayHasKey('counterOrderId', $item);
            $this->assertArrayHasKey('createdAt', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('stop', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertArrayHasKey('funds', $item);
            $this->assertArrayHasKey('tradeId', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Fill $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetRecentList(Fill $api)
    {
        $items = $api->getRecentList();
        var_dump($items);
        foreach ($items as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('side', $item);
            $this->assertArrayHasKey('forceTaker', $item);
            $this->assertArrayHasKey('orderId', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('feeCurrency', $item);
            $this->assertArrayHasKey('liquidity', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('feeRate', $item);
            $this->assertArrayHasKey('counterOrderId', $item);
            $this->assertArrayHasKey('createdAt', $item);
            $this->assertArrayHasKey('size', $item);
            $this->assertArrayHasKey('stop', $item);
            $this->assertArrayHasKey('price', $item);
            $this->assertArrayHasKey('funds', $item);
            $this->assertArrayHasKey('tradeId', $item);
        }
    }
}