<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Position
 * @package KuCoin\Futures\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#positions
 */
class Position extends KuCoinFuturesApi
{
    /**
     * Get the position list of a symbol.
     *
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2List instead
     *
     */
    public function getList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/positions');
        return $response->getApiData();
    }

    /**
     * Get the position details of a symbol.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use getV2Detail instead
     *
     *
     */
    public function getDetail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/position', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Change auto append status.
     *
     * @param string $symbol
     * @param boolean $status
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use changeV2AutoAppendStatus instead
     *
     */
    public function changeAutoAppendStatus($symbol, $status)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/position/margin/auto-deposit-status',
            compact('symbol', 'status')
        );
        return $response->getApiData();
    }

    /**
     * Get whether to automatically add margin status.
     *
     * @param string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated
     *
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
     * @param array $params
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     * @deprecated V2.0 use marginV2Append instead
     *
     */
    public function marginAppend(array $params)
    {
        $response = $this->call(Request::METHOD_POST,
            '/api/v1/position/margin/deposit-margin', $params
        );
        return $response->getApiData();
    }
}
