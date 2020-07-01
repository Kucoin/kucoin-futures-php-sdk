<?php

namespace KuMEX\SDK\PublicApi;

use KuMEX\SDK\Http\Request;
use KuMEX\SDK\KuMEXApi;

/**
 * Class Contract
 * @package KuMEX\SDK\PublicApi
 * @see https://docs.kucoin.com/futures/#get-open-contract-list
 */
class Contract extends KuMEXApi
{
    /**
     * Get a list of contract.
     *
     * @return array
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/contracts/active');
        return $response->getApiData();
    }

    /**
     * Get the details of a contract.
     *
     * @param  string $symbol
     * @return array
     * @throws \KuMEX\SDK\Exceptions\BusinessException
     * @throws \KuMEX\SDK\Exceptions\HttpException
     * @throws \KuMEX\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/contracts/' . $symbol);
        return $response->getApiData();
    }
}
