<?php

namespace KuCoin\Futures\SDK\Http;

use KuCoin\Futures\SDK\Exceptions\HttpException;
use KuCoin\Futures\SDK\Exceptions\InvalidApiUriException;

interface IHttp
{
    /**
     * @param Request $request
     * @param float|int $timeout in seconds
     * @return Response
     * @throws HttpException
     * @throws InvalidApiUriException
     */
    public function request(Request $request, $timeout = 30);
}