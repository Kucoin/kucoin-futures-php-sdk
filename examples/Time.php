<?php
include '../vendor/autoload.php';

use KuCoin\Futures\SDK\KuCoinFuturesApi;
use KuCoin\Futures\SDK\PublicApi\Time;

// Set the base uri, default "https://api-futures.kucoin.com" for production environment.
// KuCoinFuturesApi::setBaseUri('https://api-futures.kucoin.com');

$api = new Time();
$timestamp = $api->timestamp();
var_dump($timestamp);
