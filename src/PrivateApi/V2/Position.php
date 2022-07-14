<?php

namespace KuCoin\Futures\SDK\PrivateApi\V2;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

class Position extends KuCoinFuturesApi
{
    /**
     * Get the position of all contracts.
     *
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2List()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/all-position');
        return $response->getApiData();
    }

    /**
     * Get the position of a contract.
     *
     * @param string $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Detail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/symbol-position', ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Increase position margin.
     *
     * @param array $params
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function marginV2Append(array $params)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/change-margin', $params);
        return $response->getApiData();
    }

    /**
     * Position PNL History.
     *
     * @param array $params
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2ClosePnLHistory(array $params)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/close-pnl-his', $params);
        return $response->getApiData();
    }
}