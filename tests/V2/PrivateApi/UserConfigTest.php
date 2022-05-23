<?php

namespace KuCoin\Futures\SDK\Tests\V2\PrivateApi;

use KuCoin\Futures\SDK\PrivateApi\V2\UserConfig;
use KuCoin\Futures\SDK\Tests\TestCase;

class UserConfigTest extends TestCase
{
    protected $apiClass = UserConfig::class;

    protected $apiWithAuth = true;

    private $testSymbol = 'SHIBUSDTM';

    /**
     * @dataProvider apiProvider
     *
     * @param UserConfig $userConfig
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testAdjustLeverages(UserConfig $userConfig)
    {
        $leverage = 2;
        $data = $userConfig->adjustLeverages($this->testSymbol, $leverage);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('leverage', $data);
        $this->assertArrayHasKey('maxRiskLimit', $data);
        $this->assertEquals(2, $data['leverage']);
    }


    /**
     * @dataProvider apiProvider
     *
     * @param UserConfig $userConfig
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetLeverages(UserConfig $userConfig)
    {
        $data = $userConfig->getLeverages();
        $this->assertTrue(is_array($data));
        foreach ($data as $datum) {
            $this->assertArrayHasKey('symbol', $datum);
            $this->assertArrayHasKey('leverage', $datum);
            $this->assertArrayHasKey('maxRiskLimit', $datum);
        }
    }


    /**
     * @dataProvider apiProvider
     *
     * @param UserConfig $userConfig
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetLeverage(UserConfig $userConfig)
    {
        $data = $userConfig->getLeverage($this->testSymbol);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('leverage', $data);
        $this->assertArrayHasKey('maxRiskLimit', $data);
    }

    /**
     * @dataProvider apiProvider
     *
     * @param UserConfig $userConfig
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testChangeV2AutoAppendStatus(UserConfig $userConfig)
    {
        $response = $userConfig->changeV2AutoAppendStatus($this->testSymbol, true);
        $this->assertNull($response);
    }
}