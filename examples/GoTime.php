<?php
include '../vendor/autoload.php';

use KuMex\SDK\Http\SwooleHttp;
use KuMex\SDK\KuMexApi;
use KuMex\SDK\PublicApi\Time;

// Set the base uri, default "https://openapi-v2.KuMex.com" for production environment.
// KuMexApi::setBaseUri('https://openapi-v2.KuMex.com');

// Require PHP 7.1+ and Swoole 2.1.2+
// Require running in cli mode
go(function () {
    $api = new Time(null, new SwooleHttp);
    $timestamp = $api->timestamp();
    var_dump($timestamp);
});