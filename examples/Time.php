<?php
include '../vendor/autoload.php';

use KuMEX\SDK\KuMEXApi;
use KuMEX\SDK\PublicApi\Time;

// Set the base uri, default "https://api.kumex.com" for production environment.
// KuMEXApi::setBaseUri('https://api.kumex.com');

$api = new Time();
$timestamp = $api->timestamp();
var_dump($timestamp);
