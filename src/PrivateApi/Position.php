<?php

namespace KuMex\SDK\PublicApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Position
 * @package KuMex\SDK\PublicApi
 * @see https://docs.KuMex.com/#symbol
 */
class Position extends KuMexApi
{
    /**
     * Get the position list of a symbol.
     *
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/positions');
        return $response->getApiData();
    }

    /**
     * Get the position details of a symbol.
     *
     * @param  string $symbol
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/position', $symbol);
        return $response->getApiData();
    }

    /**
     * Change auto append status.
     *
     * @param  string $symbol
     * @param  boolean $status
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function changeAutoAppendStatus($symbol, $status)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/position/margin/auto-append-status',
            compact('symbol', 'status')
        );
        return $response->getApiData();
    }

    /**
     * Get whether to automatically add margin status.
     *
     * @param  string $symbol
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getMarginAppend($symbol, $status)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/position/margin/append',
            compact('symbol', 'status')
        );
        return $response->getApiData();
    }

    /**
     * Margin Append.
     *
     * @param  string $symbol
     * @param  array $params
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function marginAppend($symbol, array $params)
    {
        $response = $this->call(Request::METHOD_POST,
            '/api/v1/position?margin/auto-append-status?symbol='.$symbol, $params
        );
        return $response->getApiData();
    }

}
