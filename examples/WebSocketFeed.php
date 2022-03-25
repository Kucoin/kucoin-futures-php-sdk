<?php
include '../vendor/autoload.php';

use KuCoin\Futures\SDK\Auth;
use KuCoin\Futures\SDK\KuCoinFuturesApi;
use KuCoin\Futures\SDK\PrivateApi\WebSocketFeed;
use Ratchet\Client\WebSocket;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

// Set the base uri, default "https://api-futures.kucoin.com" for production environment.
// KuCoinFuturesApi::setBaseUri('https://api-futures.kucoin.com');

$auth = null;
// Need to pass the Auth parameter when subscribing to a private channel($api->subscribePrivateChannel()).
// $auth = new Auth('key', 'secret', 'passphrase');
$api = new WebSocketFeed($auth);

// Use a custom event loop instance if you like
//$loop = Factory::create();
//$loop->addPeriodicTimer(1, function () {
//    var_dump(date('Y-m-d H:i:s'));
//});
//$api->setLoop($loop);

$query    = ['connectId' => uniqid('', true)];
$channels = [
    ['topic' => '/contractMarket/ticker:XBTUSDM'], // Subscribe multiple channels
    ['topic' => '/contractMarket/ticker:XBTUSDTM'],
];

$api->subscribePublicChannels($query, $channels, function (array $message, WebSocket $ws, LoopInterface $loop) use ($api) {
    var_dump($message);

    // Subscribe another channel
    // $ws->send(json_encode($api->createSubscribeMessage('/contractMarket/ticker:ETHUSDTM')));

    // Unsubscribe the channel
    // $ws->send(json_encode($api->createUnsubscribeMessage('/contractMarket/ticker:XBTUSDM')));

    // Stop loop
    // $loop->stop();
}, function ($code, $reason) {
    echo "OnClose: {$code} {$reason}\n";
});