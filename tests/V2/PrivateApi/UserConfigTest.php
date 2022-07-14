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
    public function testAdjustLeveragesV2(UserConfig $userConfig)
    {
        $leverage = 5;
        $data = $userConfig->adjustLeveragesV2($this->testSymbol, $leverage);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('leverage', $data);
        $this->assertArrayHasKey('maxRiskLimit', $data);
        $this->assertEquals(5, $data['leverage']);
    }


    /**
     * @dataProvider apiProvider
     *
     * @param UserConfig $userConfig
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV2Leverages(UserConfig $userConfig)
    {
        $data = $userConfig->getV2Leverages();
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
    public function testGetV2Leverage(UserConfig $userConfig)
    {
        $data = $userConfig->getV2Leverage($this->testSymbol);
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
        $this->assertTrue($response);
    }
}