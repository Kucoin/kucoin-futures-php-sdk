<?php

namespace KuMEX\SDK;

interface IAuth
{
    public function signature($requestUri, $body, $timestamp, $method);

    public function getHeaders($method, $requestUri, $body);
}