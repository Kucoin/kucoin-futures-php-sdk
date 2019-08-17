<?php

namespace KuMEX\SDK\Tests;

use KuMEX\SDK\PublicApi\Time;

class TimeTest extends TestCase
{
    protected $apiClass    = Time::class;
    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     * @param Time $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testTimestamp(Time $api)
    {
        $timestamp = $api->timestamp();
        $this->assertInternalType('int', $timestamp);
    }
}