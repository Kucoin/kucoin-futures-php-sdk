<?php

namespace KuMEX\SDK\Http;

use KuMEX\SDK\Exceptions\HttpException;
use KuMEX\SDK\Exceptions\InvalidApiUriException;

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