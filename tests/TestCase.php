<?php

namespace KuMEX\SDK\Tests;

use KuMEX\SDK\Auth;
use KuMEX\SDK\Http\GuzzleHttp;
use KuMEX\SDK\KuMEXApi;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected $apiClass    = 'Must be declared in the subclass';
    protected $apiWithAuth = false;

    public function apiProvider()
    {
        $apiKey           = getenv('API_KEY');
        $apiSecret        = getenv('API_SECRET');
        $apiPassPhrase    = getenv('API_PASSPHRASE');
        $apiBaseUri       = getenv('API_BASE_URI');
        $apiSkipVerifyTls = (bool)getenv('API_SKIP_VERIFY_TLS');
        $apiDebugMode     = (bool)getenv('API_DEBUG_MODE');
        KuMEXApi::setSkipVerifyTls($apiSkipVerifyTls);
        KuMEXApi::setDebugMode($apiDebugMode);
        if ($apiBaseUri) {
            KuMEXApi::setBaseUri($apiBaseUri);
        }

        $auth = new Auth($apiKey, $apiSecret, $apiPassPhrase);
        return [
            [new $this->apiClass($this->apiWithAuth ? $auth : null)],
            [new $this->apiClass($this->apiWithAuth ? $auth : null, new GuzzleHttp(['skipVerifyTls' => $apiSkipVerifyTls]))],
            //[new $this->apiClass($this->apiWithAuth ? $auth : null, new SwooleHttp(['skipVerifyTls' => $apiSkipVerifyTls]))],
        ];
    }

    protected function assertPagination($data)
    {
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('totalNum', $data);
        $this->assertArrayHasKey('totalPage', $data);
        $this->assertArrayHasKey('pageSize', $data);
        $this->assertArrayHasKey('currentPage', $data);
        $this->assertArrayHasKey('items', $data);
        $this->assertInternalType('array', $data['items']);
    }
}