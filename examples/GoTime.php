<?php
include '../vendor/autoload.php';

use KuCoin\Futures\SDK\Http\SwooleHttp;
use KuCoin\Futures\SDK\KuCoinFuturesApi;
use KuCoin\Futures\SDK\PublicApi\Time;

// Set the base uri, default "https://api.kumex.com" for production environment.
// KuCoinFuturesApi::setBaseUri('https://api.kumex.com');

// Require PHP 7.1+ and Swoole 2.1.2+
// Require running in cli mode
go(function () {
    $api = new Time(null, new SwooleHttp);
    $timestamp = $api->timestamp();
    var_dump($timestamp);
});