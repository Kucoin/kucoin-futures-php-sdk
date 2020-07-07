<?php

namespace KuMEX\SDK\Tests;

use KuMEX\SDK\PublicApi\Status;

class StatusTest extends TestCase
{
    protected $apiClass    = Status::class;
    protected $apiWithAuth = false;

    /**
     * @dataProvider apiProvider
     * @param Status $api
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetStatus(Status $api)
    {
        $status = $api->status();
        $this->assertInternalType('array', $status);
        $this->assertArrayHasKey('msg', $status);
        $this->assertArrayHasKey('status', $status);
    }
}