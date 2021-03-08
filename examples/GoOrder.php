<?php
include '../vendor/autoload.php';

use KuCoin\Futures\SDK\Auth;
use KuCoin\Futures\SDK\Http\SwooleHttp;
use KuCoin\Futures\SDK\KuCoinFuturesApi;
use KuCoin\Futures\SDK\PrivateApi\Order;

// Set the base uri, default "https://api.kumex.com" for production environment.
// KuCoinFuturesApi::setBaseUri('https://api.kumex.com');

// Require PHP 7.1+ and Swoole 2.1.2+
// Require running in cli mode
go(function () {
    $auth = new Auth('key', 'secret', 'passphrase');
    $api = new Order($auth, new SwooleHttp);

    // Create 50 orders CONCURRENTLY in 1 second
    for ($i = 0; $i < 50; $i++) {
        go(function () use ($api, $i) {
            $order = [
                'clientOid' => uniqid(),
                'price'     => '1',
                'size'      => '1',
                'symbol'    => 'BTC-USDT',
                'type'      => 'limit',
                'side'      => 'buy',
                'remark'    => 'ORDER#' . $i,
            ];
            try {
                $result = $api->create($order);
                var_dump($result);
            } catch (\Throwable $e) {
                var_dump($e->getMessage());
            }
        });
    }
});