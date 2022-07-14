<?php

namespace KuCoin\Futures\SDK\PrivateApi\V2;

use KuCoin\Futures\SDK\Http\Request;
use KuCoin\Futures\SDK\KuCoinFuturesApi;

/**
 * Class UserConfig
 * @package KuCoin\Futures\SDK\PrivateApi\V2
 *
 * @see https://docs.kucoin.com/futures/new/#user
 *
 */
class UserConfig extends KuCoinFuturesApi
{
    /**
     * Get the user’s global leverage.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Leverage($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/user-config/leverage', ['symbol' => $symbol]);
        return $response->getApiData();
    }

    /**
     * Get user global leverage (all contracts).
     *
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getV2Leverages()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/user-config/leverages');
        return $response->getApiData();
    }

    /**
     * Modify the user’s global leverage.
     *
     * @param $symbol
     * @param $leverage
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function adjustLeveragesV2($symbol, $leverage)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/user-config/adjust-leverage', compact('symbol', 'leverage'));
        return $response->getApiData();
    }

    /**
     *  Modify the user's auto deposit margin status.
     *
     * @param $symbol
     * @param $autoDeposit
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function changeV2AutoAppendStatus($symbol, $autoDeposit)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/user-config/change-auto-deposit',
            compact('symbol', 'autoDeposit')
        );

        return $response->getApiData();
    }
}