<?php
include '../vendor/autoload.php';

use KuMEX\SDK\Auth;
use KuMEX\SDK\KuMEXApi;
use KuMEX\SDK\PrivateApi\Account;
use KuMEX\SDK\Exceptions\HttpException;
use KuMEX\SDK\Exceptions\BusinessException;

// Set the base uri, default "https://api.kumex.com" for production environment.
// KuMEXApi::setBaseUri('https://api.kumex.com');

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
