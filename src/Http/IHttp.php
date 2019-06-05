<?php

namespace KuMex\SDK\Http;

use KuMex\SDK\Exceptions\HttpException;
use KuMex\SDK\Exceptions\InvalidApiUriException;

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