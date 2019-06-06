<?php

namespace KuMex\SDK\PublicApi;

use KuMex\SDK\Http\Request;
use KuMex\SDK\KuMexApi;

/**
 * Class Contract
 * @package KuMex\SDK\PublicApi
 * @see https://docs.KuMex.com/#contracts
 */
class Contract extends KuMexApi
{
    /**
     * Get a list of contract.
     *
     * @return array
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
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
     * @throws \KuMex\SDK\Exceptions\BusinessException
     * @throws \KuMex\SDK\Exceptions\HttpException
     * @throws \KuMex\SDK\Exceptions\InvalidApiUriException
     */
    public function getDetail($symbol)
    {
        $response = $this->call(Request::METHOD_GET, '/api/v1/contracts/' . $symbol);
        return $response->getApiData();
    }
}
