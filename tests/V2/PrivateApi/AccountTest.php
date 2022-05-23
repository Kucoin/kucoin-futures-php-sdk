<?php

namespace KuCoin\Futures\SDK\Tests\V2\PrivateApi;

use KuCoin\Futures\SDK\PrivateApi\V2\Account;
use KuCoin\Futures\SDK\Tests\TestCase;

class AccountTest extends TestCase
{
    protected $apiClass = Account::class;

    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     *
     * @param Account $account
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2Overview(Account $account)
    {
        $data = $account->getV2Overview();
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('walletBalance', $item);
            $this->assertArrayHasKey('positionMargin', $item);
            $this->assertArrayHasKey('orderMargin', $item);
            $this->assertArrayHasKey('availableBalance', $item);
            $this->assertArrayHasKey('unrealisedPNL', $item);
            $this->assertArrayHasKey('accountEquity', $item);
            $this->assertArrayHasKey('holdBalance', $item);
            $this->assertArrayHasKey('availableTransferBalance', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Account $account
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testTransferV2In(Account $account)
    {
        $data = $account->transferInV2('10', 'USDT', 'MAIN');
        $this->assertNull($data);
    }


    /**
     * @dataProvider apiProvider
     *
     * @param Account $account
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2TransactionHistory(Account $account)
    {
        $data = $account->getV2TransactionHistory();
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('walletBalance', $item);
            $this->assertArrayHasKey('remark', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Account $account
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testTransferOutV2(Account $account)
    {
        $data = $account->transferOutV2('0.1', 'USDT', 'MAIN');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('applyId', $data);
        $this->assertArrayHasKey('bizNo', $data);
        $this->assertArrayHasKey('payTag', $data);
        $this->assertArrayHasKey('remark', $data);
        $this->assertArrayHasKey('recAccountType', $data);
        $this->assertArrayHasKey('recTag', $data);
        $this->assertArrayHasKey('recRemark', $data);
        $this->assertArrayHasKey('recSystem', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('currency', $data);
        $this->assertArrayHasKey('amount', $data);
        $this->assertArrayHasKey('fee', $data);
        $this->assertArrayHasKey('sn', $data);
        $this->assertArrayHasKey('reason', $data);
        $this->assertArrayHasKey('createdAt', $data);
        $this->assertArrayHasKey('updatedAt', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Account $account
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2TransferList(Account $account)
    {
        $data = $account->getV2TransferList();
        $this->assertInternalType('array', $data);
        foreach ($data as $item) {
            $this->assertInternalType('array', $item);
            $this->assertArrayHasKey('applyId', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('recRemark', $item);
            $this->assertArrayHasKey('recSystem', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('reason', $item);
            $this->assertArrayHasKey('sn', $item);
            $this->assertArrayHasKey('createdAt', $item);
            $this->assertArrayHasKey('remark', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     *
     * @param Account $account
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2FundingHistory(Account $account)
    {
        $params = [
            'symbol' => 'SHIBUSDTM',
        ];

        $data = $account->getV2FundingHistory($params);
        $this->assertInternalType('array', $data);
        foreach ($data['dataList'] as $item) {
            $this->assertArrayHasKey('symbol', $item);
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('fundingRate', $item);
            $this->assertArrayHasKey('timePoint', $item);
            $this->assertArrayHasKey('markPrice', $item);
            $this->assertArrayHasKey('qty', $item);
            $this->assertArrayHasKey('entryValue', $item);
            $this->assertArrayHasKey('funding', $item);
            $this->assertArrayHasKey('settleCurrency', $item);
        }
    }

    ///**
    // * @dataProvider apiProvider
    // *
    // * @param Account $account
    // * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
    // * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
    // * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
    // */
    //public function testCancelV2TransferOut(Account $account)
    //{
    //    $trans = $account->transferOutV2('1', 'USDT', 'MAIN');
    //    $applyId = $trans['applyId'];
    //    $data = $account->cancelV2TransferOut($applyId);
    //    $this->assertNull($data);
    //}

    ///**
    // * @dataProvider apiProvider
    // *
    // * @param Account $account
    // * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
    // * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
    // * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
    // */
    //public function testGetV2SubAccounts(Account $account)
    //{
    //    $data = $account->getV2SubAccounts();
    //}
}