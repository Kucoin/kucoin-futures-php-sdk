<?php

namespace KuMex\SDK\Tests;

use KuMex\SDK\PublicApi\Time;

class TimeTest extends TestCase
{
    protected $apiClass    = Time::class;
    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     * @param Time $api
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function testTimestamp(Time $api)
    {
        $timestamp = $api->timestamp();
        $this->assertInternalType('int', $timestamp);
    }
}