<?php
include '../vendor/autoload.php';

use KuMEX\SDK\KuMEXApi;
use KuMEX\SDK\PublicApi\Status;

// Set the base uri, default "https://api.kumex.com" for production environment.
// KuMEXApi::setBaseUri('https://api.kumex.com');

$api = new Status();
$status = $api->status();
var_dump($status);
