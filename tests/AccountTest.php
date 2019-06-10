<?php

namespace KuMex\SDK\Tests;

use KuMex\SDK\ApiCode;
use KuMex\SDK\Exceptions\BusinessException;
use KuMex\SDK\PrivateApi\Account;

class AccountTest extends TestCase
{
    protected $apiClass = Account::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetOverview(Account $api)
    {
        $accounts = $api->getOverview();
        $this->assertInternalType('array', $accounts);
        $this->assertArrayHasKey('accountEquity', $accounts);
        $this->assertArrayHasKey('unrealisedPNL', $accounts);
        $this->assertArrayHasKey('marginBalance', $accounts);
        $this->assertArrayHasKey('positionMargin', $accounts);
        $this->assertArrayHasKey('orderMargin', $accounts);
        $this->assertArrayHasKey('frozenFunds', $accounts);
        $this->assertArrayHasKey('availableBalance', $accounts);
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetTransactionHistory(Account $api)
    {
        $accounts = $api->getTransactionHistory();
        $this->assertInternalType('array', $accounts);
        foreach ($accounts['dataList'] as $item) {
            $this->assertArrayHasKey('time', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('accountEquity', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('remark', $item);
            $this->assertArrayHasKey('offset', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testTransferIn(Account $api)
    {
        $amount   = 100.123;
        $accounts = $api->transferIn($amount);
        $this->assertInternalType('array', $accounts);
        if (isset($accounts[0])) {
            $this->assertArrayHasKey('applyId', $accounts);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testTransferOut(Account $api)
    {
        $bizNo    = 100.100;
        $amount   = 100.123;
        $accounts = $api->transferOut($bizNo, $amount);
        $this->assertInternalType('array', $accounts);
        if (isset($accounts[0])) {
            $this->assertArrayHasKey('applyId', $accounts);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testCancelTransferOut(Account $api)
    {
        $applyId = 100;
        $accounts = $api->cancelTransferOut($applyId);
        $this->assertNull($accounts);
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetTransferList(Account $api)
    {
        $accounts = $api->getTransactionHistory();
        $this->assertInternalType('array', $accounts);
        foreach ($accounts as $item) {
            $this->assertArrayHasKey('applyId', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('offset', $item);
        }
    }

}
