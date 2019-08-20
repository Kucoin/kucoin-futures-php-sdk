<?php

namespace KuMEX\SDK\PublicApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Time
 * @package KuMEX\SDK\PublicApi
 * @see https://docs.KuMEX.com/#time
 */
class Time extends KuMEXApi
{
    /**
     * Get the timestamp of Server in milliseconds
     * @return int
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function timestamp()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/timestamp');
        return $response->getApiData();
    }
}