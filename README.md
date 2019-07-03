
# PHP SDK for KuMex API
> The detailed document [https://docs.kumex.com](https://docs.kumex.com), in order to receive the latest API change notifications, please `Watch` this repository.

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
| -------- | -------- |
| *Production* `DEFAULT` | https://api.kumex.com|
| *Sandbox* | https://sandbox-api.kumex.com |

```php
// Switch to the sandbox environment
KuMexApi::setBaseUri('https://sandbox-api.kumex.com');
```

### Debug mode & logging

```php
// Debug mode will record the logs of API and WebSocket to files in the directory "KuMexApi::getLogPath()" according to the minimum log level "KuMexApi::getLogLevel()".
KuMexApi::setDebugMode(true);

// Logging in your code
// KuMexApi::setLogPath('/tmp');
// KuMexApi::setLogLevel(Monolog\Logger::DEBUG);
KuMexApi::getLogger()->debug("I'am a debug message");
```

### Examples
> See the [test case](tests) for more examples.

#### Example of API `without` authentication

```php
use KuMex\SDK\PublicApi\Time;

$api = new Time();
$timestamp = $api->timestamp();
var_dump($timestamp);
```

#### Example of API `with` authentication

```php
use KuMex\SDK\Auth;
use KuMex\SDK\PrivateApi\Account;
use KuMex\SDK\Exceptions\HttpException;
use KuMex\SDK\Exceptions\BusinessException;

$auth = new Auth('key', 'secret', 'passphrase');
$api = new Account($auth);

try {
    $result = $api->getList(['type' => 'main']);
    var_dump($result);
} catch (HttpException $e) {
    var_dump($e->getMessage());
} catch (BusinessException $e) {
    var_dump($e->getMessage());
}
```

#### Example of WebSocket feed

```php
use KuMex\SDK\Auth;
use KuMex\SDK\PrivateApi\WebSocketFeed;
use Ratchet\Client\WebSocket;
use React\EventLoop\LoopInterface;

$auth = null;
// Need to pass the Auth parameter when subscribing to a private channel($api->subscribePrivateChannel()).
// $auth = new Auth('key', 'secret', 'passphrase');
$api = new WebSocketFeed($auth);

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
use KuMex\SDK\Auth;
use KuMex\SDK\Http\SwooleHttp;
use KuMex\SDK\KuMexApi;
use KuMex\SDK\PrivateApi\Order;
use KuMex\SDK\PublicApi\Time;

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
<summary>KuMex\SDK\PrivateApi\Account</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PrivateApi\Account::getOverview() | YES | https://docs.kumex.com/#account |
| KuMex\SDK\PrivateApi\Account::getTransactionHistory() | YES | https://docs.kumex.com/#get-transaction-history |
| KuMex\SDK\PrivateApi\Account::transferIn() | YES | https://docs.kumex.com/#transfer-funds-from-kucoin-main-account-to-kumex-account |
| KuMex\SDK\PrivateApi\Account::transferOut() | YES | https://docs.kumex.com/##transfer-funds-from-kumex-account-to-kucoin-main-account |
| KuMex\SDK\PrivateApi\Account::cancelTransferOut() | YES | https://docs.kumex.com/#cancel-transfer-out-request |
| KuMex\SDK\PrivateApi\Account::getTransferList() | YES | https://docs.kumex.com/#get-transfer-out-request-records |
</details>

<details>
<summary>KuMex\SDK\PrivateApi\Deposit</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PrivateApi\Deposit::getAddress() | YES | https://docs.kumex.com/#get-deposit-address |
| KuMex\SDK\PrivateApi\Deposit::getDeposits() | YES | https://docs.kumex.com/#get-deposit-list |

</details>

<details>
<summary>KuMex\SDK\PrivateApi\Fill</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PrivateApi\Fill::getFills() | YES | https://docs.kumex.com/#list-fills |
| KuMex\SDK\PrivateApi\Fill::getRecentList() | YES | https://docs.kumex.com/#recent-fills |
| KuMex\SDK\PrivateApi\Order::getOpenOrderStatistics() | YES | https://docs.kumex.com/#active-order-value-calculation |

</details>

<details>
<summary>KuMex\SDK\PrivateApi\Order</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PrivateApi\Order::create() | YES | https://docs.kumex.com/#place-a-new-order |
| KuMex\SDK\PrivateApi\Order::cancel() | YES | https://docs.kumex.com/#cancel-an-order |
| KuMex\SDK\PrivateApi\Order::batchCancel() | YES | https://docs.kumex.com/#cancel-all-orders |
| KuMex\SDK\PrivateApi\Order::stopOrders() | YES | https://docs.kumex.com/#list-orders |
| KuMex\SDK\PrivateApi\Order::getList() | YES | https://docs.kumex.com/#get-v1-historical-orders-list |
| KuMex\SDK\PrivateApi\Order::getStopOrders() | YES | https://docs.kumex.com/#get-an-order |
| KuMex\SDK\PrivateApi\Order::getRecentDoneOrders() | YES | https://docs.kumex.com/#recent-orders |
| KuMex\SDK\PrivateApi\Order::getDetail() | YES | https://docs.kumex.com/#recent-orders |
| KuMex\SDK\PrivateApi\Order::getOpenOrderStatistics() | YES | https://docs.kumex.com/#recent-orders |

</details>

<details>
<summary>KuMex\SDK\PrivateApi\WebSocketFeed</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PrivateApi\WebSocketFeed::getPublicServer() | NO | https://docs.kumex.com/#apply-connect-token |
| KuMex\SDK\PrivateApi\WebSocketFeed::getPrivateServer() | YES | https://docs.kumex.com/#apply-connect-token |
| KuMex\SDK\PrivateApi\WebSocketFeed::subscribePublicChannel() | NO | https://docs.kumex.com/#public-channels |
| KuMex\SDK\PrivateApi\WebSocketFeed::subscribePublicChannels() | NO | https://docs.kumex.com/#public-channels |
| KuMex\SDK\PrivateApi\WebSocketFeed::subscribePrivateChannel() | YES | https://docs.kumex.com/#private-channels |
| KuMex\SDK\PrivateApi\WebSocketFeed::subscribePrivateChannels() | YES | https://docs.kumex.com/#private-channels |

</details>

<details>
<summary>KuMex\SDK\PrivateApi\Withdrawal</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PrivateApi\Withdrawal::getQuotas() | YES | https://docs.kumex.com/#get-withdrawal-quotas |
| KuMex\SDK\PrivateApi\Withdrawal::getList() | YES | https://docs.kumex.com/#get-withdrawals-list |
| KuMex\SDK\PrivateApi\Withdrawal::apply() | YES | https://docs.kumex.com/#apply-withdraw |
| KuMex\SDK\PrivateApi\Withdrawal::cancel() | YES | https://docs.kumex.com/#cancel-withdrawal |

</details>

<details>
<summary>KuMex\SDK\PublicApi\Symbol</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PublicApi\Symbol::getTicker() | NO | https://docs.kumex.com/#get-ticker |
| KuMex\SDK\PublicApi\Symbol::getLevel2Snapshot() | NO | https://docs.kumex.com/#get-full-order-book-level-2 |
| KuMex\SDK\PublicApi\Symbol::getLevel3Snapshot() | NO | https://docs.kumex.com/#get-full-order-book-level-3 |
| KuMex\SDK\PublicApi\Symbol::getLevel2Message() | NO | https://docs.kumex.com/##level-2-pulling-messages |
| KuMex\SDK\PublicApi\Symbol::getLevel3Message() | NO | https://docs.kumex.com/##level-3-pulling-messages |
| KuMex\SDK\PublicApi\Symbol::getTradeHistory() | NO | https://docs.kumex.com/#get-trade-histories |

</details>

<details>
<summary>KuMex\SDK\PublicApi\Time</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuMex\SDK\PublicApi\Time::timestamp() | NO | https://docs.kumex.com/#server-time |

</details>

## Run tests
> Modify your API key in `phpunit.xml` first.

```shell
# Add your API configuration items into the environmental variable first
export API_BASE_URI=https://api.kumex.com
export API_KEY=key
export API_SECRET=secret
export API_PASSPHRASE=passphrase

composer test
```

## License

[MIT](LICENSE)
