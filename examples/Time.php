<?php
include '../vendor/autoload.php';

use KuMex\SDK\KuMexApi;
use KuMex\SDK\PublicApi\Time;

// Set the base uri, default "https://api.kumex.com" for production environment.
// KuMexApi::setBaseUri('https://api.kumex.com');

$api = new Time();
$timestamp = $api->timestamp();
var_dump($timestamp);
