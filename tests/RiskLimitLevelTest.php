<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PrivateApi\RiskLimitLevel;

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