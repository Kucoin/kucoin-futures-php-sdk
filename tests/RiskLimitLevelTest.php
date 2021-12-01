<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PrivateApi\RiskLimitLevel;


/**
 * Class RiskLimitLevel
 * @package KuCoin\Futures\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#obtain-futures-risk-limit-level
 */
class RiskLimitLevelTest extends TestCase
{
    protected $apiClass    = RiskLimitLevel::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     *
     * @param RiskLimitLevel $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testChangeRiskLimitLevel(RiskLimitLevel $api)
    {
        $data = $api->changeRiskLimitLevel('ADAUSDTM', 2);
        $this->assertInternalType('bool', $data);
    }
}