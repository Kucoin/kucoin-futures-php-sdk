<?php

namespace KuMex\SDK\Tests;

use KuMex\SDK\Auth;
use KuMex\SDK\Http\GuzzleHttp;
use KuMex\SDK\KuMexApi;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $apiClass = 'Must be declared in the subclass';
    protected $apiWithAuth = false;

    public function apiProvider()
    {
        $apiKey           = "5d27fad1ef83c7206c39ea94";
        $apiSecret        = "8428e2a7-dd18-4c71-acd1-feface4088fd";
        $apiPassPhrase    = "123456789";
        $apiBaseUri       = "https://sandbox-api.kumex.com";
        $apiSkipVerifyTls = (bool)getenv('API_SKIP_VERIFY_TLS');
        $apiDebugMode     = (bool)getenv('API_DEBUG_MODE');
        KuMexApi::setSkipVerifyTls($apiSkipVerifyTls);
        KuMexApi::setDebugMode($apiDebugMode);
        if ($apiBaseUri) {
            KuMexApi::setBaseUri($apiBaseUri);
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