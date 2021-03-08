<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PublicApi\Time;

class TimeTest extends TestCase
{
    protected $apiClass    = Time::class;
    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     * @param Time $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testTimestamp(Time $api)
    {
        $timestamp = $api->timestamp();
        $this->assertInternalType('int', $timestamp);
    }
}