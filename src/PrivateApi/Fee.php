<?php

namespace KuCoin\Futures\SDK\PrivateApi;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class Fill
 * @package KuCoin\Futures\SDK\PrivateApi
 * @see https://www.kucoin.com/docs/rest/funding/trade-fee/trading-pair-actual-fee-futures
 */
class Fee extends KuCoinFuturesApi
{
    /**
     * This interface is for the actual fee rate of the trading pair. The fee rate of your sub-account is the same as that of the master account.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getTradeFees($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/trade-fees', compact('symbol'));
        return $response->getApiData();
    }
}
