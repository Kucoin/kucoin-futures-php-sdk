<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PrivateApi\RiskLimitLevel;

class RiskLimitLevelTest extends TestCase
{
    protected $apiClass    = RiskLimitLevel::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param RiskLimitLevel $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetRiskLimit(RiskLimitLevel $api)
    {
        $data = $api->getRiskLimitLevel('ADAUSDTM');
        $this->assertInternalType('array', $data);
        foreach ($data as $datum) {
            $this->assertArrayHasKey('symbol', $datum);
            $this->assertArrayHasKey('level', $datum);
            $this->assertArrayHasKey('maxRiskLimit', $datum);
            $this->assertArrayHasKey('minRiskLimit', $datum);
            $this->assertArrayHasKey('maxLeverage', $datum);
            $this->assertArrayHasKey('initialMargin', $datum);
            $this->assertArrayHasKey('maintainMargin', $datum);
        }
    }

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