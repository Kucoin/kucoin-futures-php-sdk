<?php

namespace KuMex\SDK\PublicApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Currency
 * @package KuMex\SDK\PublicApi
 * @see https://docs.KuMex.com/#currencies
 */
class Currency extends KuMexApi
{
    /**
     * Get a list of currency
     * @return array
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/currencies');
        return $response->getApiData();
    }

    /**
     * Get the details of a currency
     * @param string $currency
     * @param string|null $chain
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetail($currency, $chain = null)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/currencies/' . $currency, compact('chain'));
        return $response->getApiData();
    }

    /**
     * Get fiat prices for currency
     * @param string|null $base
     * @param string|null $currencies
     * @return array
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getPrices($base = null, $currencies = null)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/prices', compact('base', 'currencies'));
        return $response->getApiData();
    }
}