<?php

namespace KuMEX\SDK\PrivateApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Fill
 * @package KuMEX\SDK\PrivateApi
 * @see https://docs.KuMEX.com/#fills
 */
class Fill extends KuMEXApi
{
    /**
     * Get fills orders list.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getRecentList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/recentFills');
        return $response->getApiData();
    }
    /**
     * Get a funding-history list.
     *
     * @param array $params
     * @param array $pagination
     * @return array
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getFundingHistory(array $params, array $pagination = [])
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/funding-history', $params + $pagination);
        return $response->getApiData();
    }

}
