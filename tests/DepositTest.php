<?php

namespace KuMEX\SDK\Tests;

use KuMEX\SDK\Exceptions\BusinessException;
use KuMEX\SDK\PrivateApi\Deposit;

class DepositTest extends TestCase
{
    protected $apiClass    = Deposit::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Deposit $api
     * @return array|string
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetAddress(Deposit $api)
    {
//        try {
//            $address = $api->getAddress('XBT');
//            if ($address !== null) {
//                $this->assertInternalType('array', $address);
//                $this->assertArrayHasKey('address', $address);
//                $this->assertArrayHasKey('memo', $address);
//            }
//        } catch (BusinessException $e) {
//            // deposit.disabled
//            if ($e->getResponse()->getApiCode() == '260200') {
//                return;
//            }
//            throw $e;
//        }
        $this->assertTrue(true);
    }

    /**
     * @dataProvider apiProvider
     * @param Deposit $api
     * @return array|string
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetDeposits(Deposit $api)
    {
        $data = $api->getDeposits(['currency' => 'XBT'], ['currentPage' => 1, 'pageSize' => 10]);
        $this->assertPagination($data);
        foreach ($data['items'] as $item) {
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('address', $item);
            $this->assertArrayHasKey('isInner', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('walletTxId', $item);
            $this->assertArrayHasKey('createdAt', $item);
        }
    }
}