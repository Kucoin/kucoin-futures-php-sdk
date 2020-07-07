<?php

namespace KuMEX\SDK\PublicApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Time
 * @package KuMEX\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#get-the-service-status
 */
class Status extends KuMEXApi
{
    /**
     * Get the timestamp of Server in milliseconds
     * @return array
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function status()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/status');
        return $response->getApiData();
    }
}