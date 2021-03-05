<?php

namespace KuCoin\Futures\SDK\Tests;

use KuCoin\Futures\SDK\PrivateApi\WebSocketFeed;
use Ratchet\Client\WebSocket;
use React\EventLoop\LoopInterface;

class WebSocketFeedTest extends TestCase
{
    protected $apiClass    = WebSocketFeed::class;
    protected $apiWithAuth = true;

    /**
     * @dataProvider apiProvider
     * @param WebSocketFeed $api
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetPublicBullet(WebSocketFeed $api)
    {
        $data = $api->getPublicBullet();
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('token', $data);
        $this->assertArrayHasKey('instanceServers', $data);
        $this->assertInternalType('array', $data['instanceServers']);
        foreach ($data['instanceServers'] as $instanceServer) {
            $this->assertArrayHasKey('endpoint', $instanceServer);
            $this->assertArrayHasKey('protocol', $instanceServer);
            $this->assertArrayHasKey('encrypt', $instanceServer);
            $this->assertInternalType('array', $instanceServer);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param WebSocketFeed $api
     * @return array
     * @throws \KuCoin\Futures\SDK\Exceptions\BusinessException
     * @throws \KuCoin\Futures\SDK\Exceptions\HttpException
     * @throws \KuCoin\Futures\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetPrivateBullet(WebSocketFeed $api)
    {
        $data = $api->getPrivateBullet();
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('token', $data);
        $this->assertArrayHasKey('instanceServers', $data);
        $this->assertInternalType('array', $data['instanceServers']);

        $wsAddress = null;
        foreach ($data['instanceServers'] as $instanceServer) {
            $this->assertInternalType('array', $instanceServer);
            $this->assertArrayHasKey('endpoint', $instanceServer);
            $this->assertArrayHasKey('protocol', $instanceServer);
            $this->assertArrayHasKey('encrypt', $instanceServer);
            if ($instanceServer['protocol'] === 'websocket') {
                $wsAddress = $instanceServer['endpoint'];
            }
        }
        return ['address' => $wsAddress, 'token' => $data['token']];
    }

    /**
     * @dataProvider apiProvider
     * @param WebSocketFeed $api
     * @throws \Exception|\Throwable
     */
    public function testSubscribePublicChannel(WebSocketFeed $api)
    {
        $query = ['connectId' => uniqid('', true),];
        $channel = ['topic' => '/contractMarket/ticker:XBTUSDM'];

        $options = [
//            'tls' => [
//                'verify_peer' => false,
//            ],
        ];
        $api->subscribePublicChannel($query, $channel, function (array $message, WebSocket $ws, LoopInterface $loop) use ($api) {
            $this->assertInternalType('array', $message);
            $this->assertArrayHasKey('type', $message);
            $this->assertArrayHasKey('channelType', $message);
            $this->assertEquals('message', $message['type']);

            // Dynamic output
            fputs(STDIN, print_r($message, true));

            // Stop for phpunit
            $loop->stop();
        }, function ($code, $reason) {
            echo "OnClose: {$code} {$reason}\n";
        }, $options);
    }

    /**
     * @dataProvider apiProvider
     * @param WebSocketFeed $api
     * @throws \Exception|\Throwable
     */
    public function testSubscribePublicChannels(WebSocketFeed $api)
    {
        $query = ['connectId' => uniqid('', true),];
        $channels = [
            ['topic' => '/contractMarket/ticker:XBTUSDM'],
            ['topic' => '/contractMarket/ticker:XBTUSDM'],
        ];

        $options = [
//            'tls' => [
//                'verify_peer' => false,
//            ],
        ];
        $api->subscribePublicChannels($query, $channels, function (array $message, WebSocket $ws, LoopInterface $loop) use ($api) {
            $this->assertInternalType('array', $message);
            $this->assertArrayHasKey('type', $message);
            $this->assertArrayHasKey('channelType', $message);
            $this->assertEquals('message', $message['type']);

            // Dynamic output
            fputs(STDIN, print_r($message, true));

            // Stop for phpunit
            $loop->stop();
        }, function ($code, $reason) {
            echo "OnClose: {$code} {$reason}\n";
        }, $options);
    }


    /**
     * @dataProvider apiProvider
     * @param WebSocketFeed $api
     * @throws \Exception|\Throwable
     */
    public function testUnsubscribePublicChannel(WebSocketFeed $api)
    {
        $query = ['connectId' => uniqid('', true),];
        $channel = ['topic' => '/contractMarket/ticker:XBTUSDM'];

        $options = [
//            'tls' => [
//                'verify_peer' => false,
//            ],
        ];
        $api->subscribePublicChannel($query, $channel, function (array $message, WebSocket $ws, LoopInterface $loop) use ($api) {
            $this->assertInternalType('array', $message);
            $this->assertArrayHasKey('type', $message);
            $this->assertArrayHasKey('channelType', $message);
            $this->assertEquals('message', $message['type']);

            // Dynamic output
            fputs(STDIN, print_r($message, true));

            // Stop for phpunit
            $loop->stop();
        }, function ($code, $reason) {
            echo "OnClose: {$code} {$reason}\n";
        }, $options);
    }

    /**
     * @dataProvider apiProvider
     * @param WebSocketFeed $api
     * @throws \Exception|\Throwable
     */
    public function testSubscribePrivateChannel(WebSocketFeed $api)
    {
        $query = ['connectId' => uniqid('', true),];
        $channel = ['topic' => '/contract/position:XBTUSDM'];

        $options = [
//            'tls' => [
//                'verify_peer' => false,
//            ],
        ];
        $api->subscribePrivateChannel($query, $channel, function (array $message, WebSocket $ws, LoopInterface $loop) use ($api) {
            $this->assertInternalType('array', $message);
            $this->assertArrayHasKey('type', $message);
            $this->assertArrayHasKey('channelType', $message);
            $this->assertEquals('message', $message['type']);
            // Dynamic output
            fputs(STDIN, print_r($message, true));

            // Stop for phpunit
            $loop->stop();
        }, function ($code, $reason) {
            echo "OnClose: {$code} {$reason}\n";
        }, $options);
    }

    /**
     * @dataProvider apiProvider
     * @param WebSocketFeed $api
     * @throws \Exception|\Throwable
     */
    public function testSubscribePrivateChannels(WebSocketFeed $api)
    {
        $query = ['connectId' => uniqid('', true),];
        $channels = [
            ['topic' => '/contract/position:XBTUSDM'],
            ['topic' => '/contract/position:XBTUSDM'],
        ];

        $options = [
//            'tls' => [
//                'verify_peer' => false,
//            ],
        ];
        $api->subscribePrivateChannels($query, $channels, function (array $message, WebSocket $ws, LoopInterface $loop) use ($api) {
            $this->assertInternalType('array', $message);
            $this->assertArrayHasKey('type', $message);
            $this->assertArrayHasKey('channelType', $message);
            $this->assertEquals('message', $message['type']);
            // Dynamic output
            fputs(STDIN, print_r($message, true));

            // Stop for phpunit
            $loop->stop();
        }, function ($code, $reason) {
            echo "OnClose: {$code} {$reason}\n";
        }, $options);
    }
}
