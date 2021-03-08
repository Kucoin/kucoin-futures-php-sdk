<?php

namespace KuCoin\Futures\SDK;

interface IAuth
{
    public function signature($requestUri, $body, $timestamp, $method);

    public function getHeaders($method, $requestUri, $body);
}