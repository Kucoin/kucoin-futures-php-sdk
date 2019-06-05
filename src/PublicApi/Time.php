<?php

namespace KuMex\SDK\PublicApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Time
 * @package KuMex\SDK\PublicApi
 * @see https://docs.KuMex.com/#time
 */
class Time extends KuMexApi
{
    /**
     * Get the timestamp of Server in milliseconds
     * @return int
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function timestamp()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/timestamp');
        return $response->getApiData();
    }
}