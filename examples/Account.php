<?php
include '../vendor/autoload.php';

use KuCoin\Futures\SDK\Auth;
use KuCoin\Futures\SDK\KuCoinFuturesApi;
use KuCoin\Futures\SDK\PrivateApi\Account;
use KuCoin\Futures\SDK\Exceptions\HttpException;
use KuCoin\Futures\SDK\Exceptions\BusinessException;

// Set the base uri, default "https://api-futures.kucoin.com" for production environment.
// KuCoinFuturesApi::setBaseUri('https://api-futures.kucoin.com');

$auth = new Auth('key', 'secret', 'passphrase');
$api = new Account($auth);

try {
    $result = $api->getOverview();
    var_dump($result);
} catch (HttpException $e) {
    var_dump($e->getMessage());
} catch (BusinessException $e) {
    var_dump($e->getMessage());
}
