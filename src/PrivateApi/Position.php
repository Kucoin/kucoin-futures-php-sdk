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
        $response = $this->call(Request::METHOD_GET, '/api/v1/position');
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

}
