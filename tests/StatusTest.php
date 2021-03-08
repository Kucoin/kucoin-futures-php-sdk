<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PublicApi\Status;

class StatusTest extends TestCase
{
    protected $apiClass    = Status::class;
    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     * @param Status $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetStatus(Status $api)
    {
        $status = $api->status();
        $this->assertInternalType('array', $status);
        $this->assertArrayHasKey('msg', $status);
        $this->assertArrayHasKey('status', $status);
    }
}