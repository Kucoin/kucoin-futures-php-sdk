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
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/position', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * Change auto append status.
     *
     * @param  string $symbol
     * @param  boolean $status
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
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
     * @deprecated
     *
     * @param  string $symbol
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
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
     * @param  array $params
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function marginAppend(array $params)
    {
        $response = $this->call(Request::METHOD_POST,
            '/api/v1/position/margin/deposit-margin', $params
        );
        return $response->getApiData();
    }


    /**
     * Get Max Withdraw Margin.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getMaxWithdrawMargin($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/margin/maxWithdrawMargin', compact('symbol'));
        return $response->getApiData();
    }
    
    /**
     * Remove Margin Manually.
     *
     * @param $symbol
     * @param $withdrawAmount
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function withdrawMargin($symbol, $withdrawAmount)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v1/margin/withdrawMargin', compact('symbol', 'withdrawAmount'));
        return $response->getApiData();
    }

    /**
     * Get Positions History.
     *
     * @param array $params
     * @return \KuCoin\Futures\SDK\Http\Response
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getHistoryPositions(array $params)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/history-positions', $params);
        return $response->getApiData();
    }

    /**
     * Get Maximum Open Position Size.
     *
     * @param $symbol
     * @param $price
     * @param $leverage
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getMaxOpenSize($symbol, $price, $leverage)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/getMaxOpenSize', compact('symbol', 'price', 'leverage'));
        return $response->getApiData();
    }

    /**
     * This interface can modify the current symbol’s cross-margin leverage multiple.
     *
     * @param $symbol
     * @param $leverage
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function modifyCrossUserLeverage($symbol, $leverage)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/changeCrossUserLeverage', compact('symbol', 'leverage'));
        return $response->getApiData();
    }

    /**
     * This interface can query the current symbol’s cross-margin leverage multiple.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getCrossUserLeverage($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/getCrossUserLeverage', compact('symbol'));
        return $response->getApiData();
    }

    /**
     * This interface can modify the margin mode of the current symbol
     *
     * @param $symbol
     * @param $marginMode
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function modifyMarginMode($symbol, $marginMode)
    {
        $response = $this->call(Request::METHOD_POST, '/api/v2/position/changeMarginMode', compact('symbol', 'marginMode'));
        return $response->getApiData();
    }

    /**
     * This interface can query the margin mode of the current symbol.
     *
     * @param $symbol
     * @return mixed|null
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function getMarginMode($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v2/position/getMarginMode', compact('symbol'));
        return $response->getApiData();
    }
}
