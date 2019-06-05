<?php
include '../vendor/autoload.php';

use KuMex\SDK\KuMexApi;
use KuMex\SDK\PublicApi\Time;

// Set the base uri, default "https://openapi-v2.KuMex.com" for production environment.
// KuMexApi::setBaseUri('https://openapi-v2.KuMex.com');

$api = new Time();
$timestamp = $api->timestamp();
var_dump($timestamp);
