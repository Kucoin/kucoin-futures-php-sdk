<?php

namespace KuMex\SDK\PrivateApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Fill
 * @package KuMex\SDK\PrivateApi
 * @see https://docs.KuMex.com/#fills
 */
class Fill extends KuMexApi
{
    /**
     * Get fills orders list.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getFills(array $params = [], array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/fills', $params + $pagination);
        return $response->getApiData();
    }

    /**
     * Get the recent orders of the latest transactions within 24 hours.
     *
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getRecentList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/recentFills');
        return $response->getApiData();
    }
}
