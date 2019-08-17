<?php
/**
 * Author: <easy> easy@kucoin.com
 * Date: 2019/6/17 下午3:08
 */

namespace KuMEX\SDK\Tests;

use \KuMEX\SDK\PublicApi\Contract;


class ContractTest extends TestCase
{

    protected $apiClass    = Contract::class;
    protected $apiWithAuth = false;

    /**
     *
     * @depends testGetList
     * @param Contract $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetList(Contract $api)
    {
        $data = $api->getList();
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
     * @param Contract $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetDetail(Contract $api)
    {
        $data = $api->getDetail('XBTUSDM');
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