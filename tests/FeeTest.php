<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PrivateApi\Fee;

class FeeTest extends TestCase
{
    protected $apiClass    = Fee::class;

    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param Fee $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetTradeFees(Fee $api)
    {
        $symbol = 'ETHUSDTM';
        $data = $api->getTradeFees($symbol);
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('symbol', $data);
        $this->assertArrayHasKey('takerFeeRate', $data);
        $this->assertArrayHasKey('makerFeeRate', $data);
    }
}
