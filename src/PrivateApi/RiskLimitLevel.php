<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class RiskLimitLevel
 * @package KuCoin\Futures\SDK\PrivateApi
 * @see https://docs.kucoin.com/futures/#obtain-futures-risk-limit-level
 */
class RiskLimitLevel extends KuCoinFuturesApi
{
    /**
     * @param $symbol
     * @param $level
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function changeRiskLimitLevel($symbol, $level)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/position/risk-limit-level/change', ['symbol' => $symbol, 'level' => $level]);
        return $response->getApiData();
    }
}