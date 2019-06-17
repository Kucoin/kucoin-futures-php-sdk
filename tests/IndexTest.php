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
     * @depends testGetList
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Index $api)
    {
        $data = $api->getList([]);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('currency', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('address', $data);
        $this->assertArrayHasKey('isInner', $data);
        $this->assertArrayHasKey('amount', $data);
        $this->assertArrayHasKey('fee', $data);
        $this->assertArrayHasKey('walletTxId', $data);
        $this->assertArrayHasKey('createdAt', $data);
    }

    /**
     *
     * @depends testGetDetail
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetInterests(Index $api)
    {
        $data = $api->getInterests([]);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('currency', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('address', $data);
        $this->assertArrayHasKey('isInner', $data);
        $this->assertArrayHasKey('amount', $data);
        $this->assertArrayHasKey('fee', $data);
        $this->assertArrayHasKey('walletTxId', $data);
        $this->assertArrayHasKey('createdAt', $data);
    }

    /**
     *
     * @depends testGetMarkPrice
     * @param Index $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetMarkPrice(Index $api)
    {
        $data = $api->getMarkPrice('XBTUSDM');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('currency', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('address', $data);
        $this->assertArrayHasKey('isInner', $data);
        $this->assertArrayHasKey('amount', $data);
        $this->assertArrayHasKey('fee', $data);
        $this->assertArrayHasKey('walletTxId', $data);
        $this->assertArrayHasKey('createdAt', $data);
    }

}