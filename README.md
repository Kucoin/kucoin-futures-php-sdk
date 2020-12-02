# DEPRECATED(弃用)

This repo is deprecated, no longer actively maintained.

---

# PHP SDK for KuMEX API

> The detailed document [https://docs.kucoin.com/futures/](https://docs.kucoin.com/futures/), in order to receive the latest API change notifications, please `Watch` this repository.

[![Latest Version](https://img.shields.io/github/release/Kucoin/kumex-php-sdk.svg)](https://github.com/Kucoin/kumex-php-sdk/releases)
[![PHP Version](https://img.shields.io/packagist/php-v/Kucoin/kumex-php-sdk.svg?color=green)](https://secure.php.net)
[![Build Status](https://travis-ci.org/Kucoin/kumex-php-sdk.svg?branch=master)](https://travis-ci.org/Kucoin/kumex-php-sdk)
[![Total Downloads](https://poser.pugx.org/Kucoin/kumex-php-sdk/downloads)](https://packagist.org/packages/Kucoin/kumex-php-sdk)
[![License](https://poser.pugx.org/Kucoin/kumex-php-sdk/license)](LICENSE)
[![Total Lines](https://tokei.rs/b1/github/Kucoin/kumex-php-sdk)](https://github.com/Kucoin/kumex-php-sdk)

## Requirements

| Dependency | Requirement |
| -------- | -------- |
| [PHP](https://secure.php.net/manual/en/install.php) | `>=5.5.0` `Recommend PHP7+` |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) | `~6.0` |

## Install
> Install package via [Composer](https://getcomposer.org/).

```shell
composer require "kucoin/kumex-php-sdk:~1.0.0"
```

## Usage

### Choose environment

| Environment | BaseUri |
|    -------- | -------- |
| *Production* | `https://api-futures.kucoin.com (DEFAULT)` `https://api-futures.kucoin.io` |
| *Sandbox* | `https://api-sandbox-futures.kucoin.com (DEFAULT)` `https://api-sandbox-futures.kucoin.io` |

```php
// Switch to the sandbox environment
KuMEXApi::setBaseUri('https://api-sandbox-futures.kucoin.com');
```

### Debug mode & logging

```php
// Debug mode will record the logs of API and WebSocket to files in the directory "KuMEXApi::getLogPath()" according to the minimum log level "KuMEXApi::getLogLevel()".
KuMEXApi::setDebugMode(true);

// Logging in your code
// KuMEXApi::setLogPath('/tmp');
// KuMEXApi::setLogLevel(Monolog\Logger::DEBUG);
KuMEXApi::getLogger()->debug("I'am a debug message");
```

### Examples
> See the [test case](tests) for more examples.

#### Example of API `without` authentication

```php
use KuMEX\SDK\PublicApi\Time;

$api = new Time();
$timestamp = $api->timestamp();
var_dump($timestamp);
```

#### Example of API `with` authentication

```php
use KuMEX\SDK\Auth;
use KuMEX\SDK\PrivateApi\Account;
use KuMEX\SDK\Exceptions\HttpException;
use KuMEX\SDK\Exceptions\BusinessException;

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
```

#### Example of WebSocket feed

```php
use KuMEX\SDK\Auth;
use KuMEX\SDK\KuMEXApi;
use KuMEX\SDK\PrivateApi\WebSocketFeed;
use Ratchet\Client\WebSocket;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

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

$query = ['connectId' => uniqid('', true)];
$channels = [
    ['topic' => '/market/ticker:KCS-BTC'], // Subscribe multiple channels
    ['topic' => '/market/ticker:ETH-BTC'],
];

$api->subscribePublicChannels($query, $channels, function (array $message, WebSocket $ws, LoopInterface $loop) use ($api) {
    var_dump($message);

    // Unsubscribe the channel
    // $ws->send(json_encode($api->createUnsubscribeMessage('/market/ticker:ETH-BTC')));

    // Stop loop
    // $loop->stop();
}, function ($code, $reason) {
    echo "OnClose: {$code} {$reason}\n";
});
```

#### ⚡️Coroutine HTTP client for asynchronous IO
> See the [benchmark](examples/BenchmarkCoroutine.php), almost `20x` faster than `curl`.

```bash
pecl install swoole
composer require swlib/saber
```

```php
use KuMEX\SDK\Auth;
use KuMEX\SDK\Http\SwooleHttp;
use KuMEX\SDK\KuMEXApi;
use KuMEX\SDK\PrivateApi\Order;
use KuMEX\SDK\PublicApi\Time;

// Require PHP 7.1+ and Swoole 2.1.2+
// Require running in cli mode

go(function () {
    $api = new Time(null, new SwooleHttp));
    $timestamp = $api->timestamp();
    var_dump($timestamp);
});

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
```

### API list

<details>
<summary>KuMEX\SDK\PrivateApi\Account</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PrivateApi\Account::getOverview() | YES | https://docs.kucoin.com/futures/#account |
| KuMEX\SDK\PrivateApi\Account::getTransactionHistory() | YES | https://docs.kucoin.com/futures/#get-transaction-history |
| KuMEX\SDK\PrivateApi\Account::transferIn() | YES | https://docs.kucoin.com/futures/#transfer-funds-from-kucoin-main-account-to-kumex-account |
| KuMEX\SDK\PrivateApi\Account::transferOut() | YES | https://docs.kucoin.com/futures/#transfer-funds-from-kumex-account-to-kucoin-main-account |
| KuMEX\SDK\PrivateApi\Account::transferOutV2() | YES | https://docs.kucoin.com/futures/#transfer-funds-from-kumex-account-to-kucoin-main-account |
| KuMEX\SDK\PrivateApi\Account::cancelTransferOut() | YES | https://docs.kucoin.com/futures/#cancel-transfer-out-request |
| KuMEX\SDK\PrivateApi\Account::getTransferList() | YES | https://docs.kucoin.com/futures/#get-transfer-out-request-records |
</details>

<details>
<summary>KuMEX\SDK\PrivateApi\Deposit</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PrivateApi\Deposit::getAddress() | YES | https://docs.kucoin.com/futures/#get-deposit-address |
| KuMEX\SDK\PrivateApi\Deposit::getDeposits() | YES | https://docs.kucoin.com/futures/#get-deposit-list |

</details>

<details>
<summary>KuMEX\SDK\PrivateApi\Fill</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PrivateApi\Fill::getFills() | YES | https://docs.kucoin.com/futures/#get-fills |
| KuMEX\SDK\PrivateApi\Fill::getRecentList() | YES | https://docs.kucoin.com/futures/#recent-fills |
</details>

<details>
<summary>KuMEX\SDK\PrivateApi\Order</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PrivateApi\Order::create() | YES | https://docs.kucoin.com/futures/#place-an-order |
| KuMEX\SDK\PrivateApi\Order::cancel() | YES | https://docs.kucoin.com/futures/#cancel-an-order |
| KuMEX\SDK\PrivateApi\Order::batchCancel() | YES | https://docs.kucoin.com/futures/#limit-order-mass-cancelation |
| KuMEX\SDK\PrivateApi\Order::stopOrders() | YES | https://docs.kucoin.com/futures/#stop-order-mass-cancelation |
| KuMEX\SDK\PrivateApi\Order::getList() | YES | https://docs.kucoin.com/futures/#get-order-list |
| KuMEX\SDK\PrivateApi\Order::getStopOrders() | YES | https://docs.kucoin.com/futures/#get-untriggered-stop-order-list |
| KuMEX\SDK\PrivateApi\Order::getRecentDoneOrders() | YES | https://docs.kucoin.com/futures/#get-list-of-orders-completed-in-24h |
| KuMEX\SDK\PrivateApi\Order::getDetail() | YES | https://docs.kucoin.com/futures/#get-details-of-a-single-order |
| KuMEX\SDK\PrivateApi\Order::getOpenOrderStatistics() | YES | https://docs.kucoin.com/futures/#active-order-value-calculation |

</details>
<details>
<summary>KuMEX\SDK\PrivateApi\Position</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PrivateApi\Position::getList() | YES | https://docs.kucoin.com/futures/#get-position-list |
| KuMEX\SDK\PrivateApi\Position::getDetail() | YES | https://docs.kucoin.com/futures/#get-position-details |
| KuMEX\SDK\PrivateApi\Position::changeAutoAppendStatus() | YES | https://docs.kucoin.com/futures/#enable-disable-of-auto-deposit-margin |
| KuMEX\SDK\PrivateApi\Position::marginAppend() | YES | https://docs.kucoin.com/futures/#add-margin-manually |
</details>

<details>
<summary>KuMEX\SDK\PrivateApi\WebSocketFeed</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PrivateApi\WebSocketFeed::getPublicServer() | NO | https://docs.kucoin.com/futures/#apply-connect-token |
| KuMEX\SDK\PrivateApi\WebSocketFeed::getPrivateServer() | YES | https://docs.kucoin.com/futures/#apply-connect-token |
| KuMEX\SDK\PrivateApi\WebSocketFeed::subscribePublicChannel() | NO | https://docs.kucoin.com/futures/#public-channels |
| KuMEX\SDK\PrivateApi\WebSocketFeed::subscribePublicChannels() | NO | https://docs.kucoin.com/futures/#public-channels |
| KuMEX\SDK\PrivateApi\WebSocketFeed::subscribePrivateChannel() | YES | https://docs.kucoin.com/futures/#private-channels |
| KuMEX\SDK\PrivateApi\WebSocketFeed::subscribePrivateChannels() | YES | https://docs.kucoin.com/futures/#private-channels |

</details>

<details>
<summary>KuMEX\SDK\PrivateApi\Withdrawal</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PrivateApi\Withdrawal::getQuotas() | YES | https://docs.kucoin.com/futures/#get-withdrawal-limit |
| KuMEX\SDK\PrivateApi\Withdrawal::getList() | YES | https://docs.kucoin.com/futures/#get-withdrawal-list |
| KuMEX\SDK\PrivateApi\Withdrawal::apply() | YES | https://docs.kucoin.com/futures/#withdraw-funds |
| KuMEX\SDK\PrivateApi\Withdrawal::cancel() | YES | https://docs.kucoin.com/futures/#cancel-withdrawal |

</details>

<details>
<summary>KuMEX\SDK\PublicApi\Symbol</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PublicApi\Symbol::getTicker() | NO | https://docs.kucoin.com/futures/#get-ticker |
| KuMEX\SDK\PublicApi\Symbol::getLevel2Snapshot() | NO | https://docs.kucoin.com/futures/#get-full-order-book-level-2 |
| KuMEX\SDK\PublicApi\Symbol::getLevel3Snapshot() | NO | https://docs.kucoin.com/futures/#get-full-order-book-level-3 |
| KuMEX\SDK\PublicApi\Symbol::getV2Level3Snapshot() | NO | https://docs.kucoin.com/futures/#get-full-order-book-level-3-v2 |
| KuMEX\SDK\PublicApi\Symbol::getLevel2Message() | NO | https://docs.kucoin.com/futures/##level-2-pulling-messages |
| KuMEX\SDK\PublicApi\Symbol::getLevel3Message() | NO | https://docs.kucoin.com/futures/##level-3-pulling-messages |
| KuMEX\SDK\PublicApi\Symbol::getTradeHistory() | NO | https://docs.kucoin.com/futures/#get-trade-histories |
| KuMEX\SDK\PublicApi\Symbol::getKLines() | NO | https://docs.kucoin.com/futures/?lang=en_US#get-k-line-data-of-contract |

</details>

<details>
<summary>KuMEX\SDK\PublicApi\Time</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PublicApi\Time::timestamp() | NO | https://docs.kucoin.com/futures/#server-time |

</details>

<details>
<summary>KuMEX\SDK\PublicApi\Status</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMEX\SDK\PublicApi\Status::status() | NO | https://docs.kucoin.com/futures/#get-the-service-status |

</details>

## Run tests
> Modify your API key in `phpunit.xml` first.

```shell
# Add your API configuration items into the environmental variable first
export API_BASE_URI=https://api-futures.kucoin.com
export API_KEY=key
export API_SECRET=secret
export API_PASSPHRASE=passphrase

composer test
```

## License

[MIT](LICENSE)
