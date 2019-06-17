<?php
include '../vendor/autoload.php';

use KuMex\SDK\Auth;
use KuMex\SDK\KuMexApi;
use KuMex\SDK\PrivateApi\Account;
use KuMex\SDK\Exceptions\HttpException;
use KuMex\SDK\Exceptions\BusinessException;

// Set the base uri, default "https://openapi-v2.KuMex.com" for production environment.
// KuMexApi::setBaseUri('https://openapi-v2.KuMex.com');

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
