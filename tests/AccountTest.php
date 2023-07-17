<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\ApiCode;
use KuCoin\Futures\SDK\Exceptions\BusinessException;
use KuCoin\Futures\SDK\PrivateApi\Account;

class AccountTest extends TestCase
{
    protected $apiClass    = Account::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetOverview(Account $api)
    {
        $accounts = $api->getOverview(['currency' => 'XBT']);
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
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetTransactionHistory(Account $api)
    {
        $accounts = $api->getTransactionHistory(['currency' => 'XBT']);
        $this->assertInternalType('array', $accounts);
        foreach ($accounts['dataList'] as $item) {
            $this->assertArrayHasKey('time', $item);
            $this->assertArrayHasKey('type', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('accountEquity', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('offset', $item);
        }
    }

    /**
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated
     * @dataProvider apiProvider
     */
//    public function testTransferIn(Account $api)
//    {
//        $amount   = 0.1;
//        $accounts = $api->transferIn($amount);
//        $this->assertInternalType('array', $accounts);
//        if (isset($accounts['applyId'])) {
//            $this->assertArrayHasKey('applyId', $accounts);
//        }
//    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testTransferOut(Account $api)
    {
        $bizNo = rand(1, 9999);
        $amount = 0.1;
        $accounts = $api->transferOut($bizNo, $amount);
        $this->assertInternalType('array', $accounts);
        if (isset($accounts['applyId'])) {
            $this->assertArrayHasKey('applyId', $accounts);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testCancelTransferOut(Account $api)
    {
        $applyId = $this->getTransferId($api);
        $accounts = $api->cancelTransferOut($applyId);
        $this->assertNull($accounts);
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetTransferList(Account $api)
    {
        $accounts = $api->getTransactionHistory();
        $this->assertInternalType('array', $accounts);
        foreach ($accounts['dataList'] as $item) {
//            $this->assertArrayHasKey('applyId', $item);
//            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('offset', $item);
        }
    }

    /**
     * @dataProvider apiProvider.
     *
     * @param Account $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    private function getTransferId($api)
    {
        $bizNo = '10000000001';
        $amount = 0.1;
        $accounts = $api->transferOut($bizNo, $amount);
        $this->assertInternalType('array', $accounts);
        return $accounts['applyId'];
    }


    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testTransferOutV2(Account $api)
    {
        $bizNo = uniqid('t_', false);
        $amount = 0.01;
        $currency = 'USDT';
        $data = $api->transferOutV2($bizNo, $amount, $currency);

        $this->assertInternalType('array', $data);

        $this->assertArrayHasKey('applyId', $data);
        $this->assertArrayHasKey('bizNo', $data);
        $this->assertArrayHasKey('payAccountType', $data);
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
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetSubApikey(Account $api)
    {
        $params = ['subName' => 'phpunittest', 'apiKey' => '647da940d35150000196a56c'];
        $data = $api->getSubApikey($params);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('apiKey', $data);
        $this->assertArrayHasKey('createdAt', $data);
        $this->assertArrayHasKey('ipWhitelist', $data);
        $this->assertArrayHasKey('permission', $data);
        $this->assertArrayHasKey('remark', $data);
        $this->assertArrayHasKey('subName', $data);
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testCreateSubApikey(Account $api)
    {
        $params = ['subName' => 'phpunittest', 'passphrase' => 'phpunit2023', 'remark' => 'remark'];
        $data = $api->createSubApikey($params);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('apiKey', $data);
        $this->assertArrayHasKey('createdAt', $data);
        $this->assertArrayHasKey('ipWhitelist', $data);
        $this->assertArrayHasKey('permission', $data);
        $this->assertArrayHasKey('remark', $data);
        $this->assertArrayHasKey('subName', $data);
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testModifySubApikey(Account $api)
    {
        $params = ['subName' => 'phpunittest', 'passphrase' => 'phpunit2023', 'apiKey' => '647d8f588de0cc0001751b6e'];
        $data = $api->modifySubApikey($params);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('apiKey', $data);
        $this->assertArrayHasKey('ipWhitelist', $data);
        $this->assertArrayHasKey('permission', $data);
        $this->assertArrayHasKey('subName', $data);
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testDeleteSubApikey(Account $api)
    {
        $params = ['subName' => 'phpunittest', 'passphrase' => 'phpunit2023', 'apiKey' => '647d8f588de0cc0001751b6e'];
        $data = $api->deleteSubApikey($params);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('apiKey', $data);
        $this->assertArrayHasKey('subName', $data);
    }

    /**
     * @dataProvider apiProvider
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testTransferOutV3(Account $api)
    {
        $recAccountType = 'MAIN';
        $amount = 0.01;
        $currency = 'USDT';
        $data = $api->transferOutV3($recAccountType, $amount, $currency);

        $this->assertInternalType('array', $data);

        $this->assertArrayHasKey('applyId', $data);
        $this->assertArrayHasKey('bizNo', $data);
        $this->assertArrayHasKey('payAccountType', $data);
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
     * @param Account $api
     * @throws BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetAccountOverviewAll(Account $api)
    {
        $currency = 'USDT';
        $data = $api->getAccountOverviewAll($currency);
        $this->assertInternalType('array', $data);
        $this->assertInternalType('array', $data['summary']);
        $this->assertArrayHasKey('accountEquityTotal', $data['summary']);
        $this->assertArrayHasKey('unrealisedPNLTotal', $data['summary']);
        $this->assertArrayHasKey('marginBalanceTotal', $data['summary']);
        $this->assertArrayHasKey('positionMarginTotal', $data['summary']);
        $this->assertArrayHasKey('orderMarginTotal', $data['summary']);
        $this->assertArrayHasKey('frozenFundsTotal', $data['summary']);
        $this->assertArrayHasKey('availableBalanceTotal', $data['summary']);
        $this->assertArrayHasKey('currency', $data['summary']);
        $this->assertEquals($currency, $data['summary']['currency']);
        $this->assertInternalType('array', $data['accounts']);
        foreach ($data['accounts'] as $item) {
            $this->assertArrayHasKey('accountName', $item);
            $this->assertArrayHasKey('accountEquity', $item);
            $this->assertArrayHasKey('unrealisedPNL', $item);
            $this->assertArrayHasKey('marginBalance', $item);
            $this->assertArrayHasKey('positionMargin', $item);
            $this->assertArrayHasKey('orderMargin', $item);
            $this->assertArrayHasKey('frozenFunds', $item);
            $this->assertArrayHasKey('availableBalance', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertEquals($currency, $item['currency']);
        }
    }
}
