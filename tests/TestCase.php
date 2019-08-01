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
        $apiKey           = getenv('API_KEY');
        $apiSecret        = getenv('API_SECRET');
        $apiPassPhrase    = getenv('API_PASSPHRASE');
        $apiBaseUri       = getenv('API_BASE_URI');
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