# PHP SDK for KuCoin Futures API

> The detailed document [https://docs.kucoin.com/futures/](https://docs.kucoin.com/futures/), in order to receive the latest API change notifications, please `Watch` this repository.

[![Latest Version](https://img.shields.io/github/release/Kucoin/kucoin-futures-php-sdk.svg)](https://github.com/Kucoin/kucoin-futures-php-sdk/releases)
[![PHP Version](https://img.shields.io/packagist/php-v/kucoin/kucoin-futures-php-sdk.svg?color=green)](https://secure.php.net)
[![Build Status](https://travis-ci.org/Kucoin/kucoin-futures-php-sdk.svg?branch=master)](https://travis-ci.org/Kucoin/kucoin-futures-php-sdk)
[![Total Downloads](https://poser.pugx.org/kucoin/kucoin-futures-php-sdk/downloads)](https://packagist.org/packages/kucoin/kucoin-futures-php-sdk)
[![License](https://poser.pugx.org/kucoin/kucoin-futures-php-sdk/license)](LICENSE)

## Requirements

| Dependency | Requirement |
| -------- | -------- |
| [PHP](https://secure.php.net/manual/en/install.php) | `>=5.5.0` `Recommend PHP7+` |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) | `~6.0` |

## Install
> Install package via [Composer](https://getcomposer.org/).

```shell
composer require "kucoin/kucoin-futures-php-sdk:~1.0.0"
```

## Usage

### Choose environment

| Environment | BaseUri |
|    -------- | -------- |
| *Production* | `https://api-futures.kucoin.com(DEFAULT)` |
| *Sandbox* | `https://api-sandbox-futures.kucoin.com` |

```php
use KuCoin\Futures\SDK\KuCoinFuturesApi;
// Switch to the sandbox environment
KuCoinFuturesApi::setBaseUri('https://api-sandbox-futures.kucoin.com');
```

### Debug mode & logging

```php
use KuCoin\Futures\SDK\KuCoinFuturesApi;
// Debug mode will record the logs of API and WebSocket to files in the directory "KuCoinFuturesApi::getLogPath()" according to the minimum log level "KuCoinFuturesApi::getLogLevel()".
KuCoinFuturesApi::setDebugMode(true);

// Logging in your code
// KuCoinFuturesApi::setLogPath('/tmp');
// KuCoinFuturesApi::setLogLevel(Monolog\Logger::DEBUG);
KuCoinFuturesApi::getLogger()->debug("I'm a debug message");
```

### Examples
> See the [test case](tests) for more examples.

#### Example of API `without` authentication

```php
use KuCoin\Futures\SDK\PublicApi\Time;

$api = new Time();
$timestamp = $api->timestamp();
var_dump($timestamp);
```

#### Example of API `with` authentication

##### **Note**
To reinforce the security of the API, KuCoin upgraded the API key to version 2.0, the validation logic has also been changed. It is recommended to create(https://www.kucoin.com/account/api) and update your API key to version 2.0. The API key of version 1.0 will be still valid until May 1, 2021


```php
use KuCoin\Futures\SDK\Auth;
use KuCoin\Futures\SDK\PrivateApi\Account;
use KuCoin\Futures\SDK\Exceptions\HttpException;
use KuCoin\Futures\SDK\Exceptions\BusinessException;

// Auth version v2 (recommend)
$auth = new Auth('key', 'secret', 'passphrase', Auth::API_KEY_VERSION_V2);
// Auth version v1
// $auth = new Auth('key', 'secret', 'passphrase');

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
use KuCoin\Futures\SDK\Auth;
use KuCoin\Futures\SDK\KuCoinFuturesApi;
use KuCoin\Futures\SDK\PrivateApi\WebSocketFeed;
use Ratchet\Client\WebSocket;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

$auth = null;
// Need to pass the Auth parameter when subscribing to a private channel($api->subscribePrivateChannel()).
// Auth version v2 (recommend)
// $auth = new Auth('key', 'secret', 'passphrase', Auth::API_KEY_VERSION_V2);
// Auth version v1
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
use KuCoin\Futures\SDK\Auth;
use KuCoin\Futures\SDK\Http\SwooleHttp;
use KuCoin\Futures\SDK\KuCoinFuturesApi;
use KuCoin\Futures\SDK\PrivateApi\Order;
use KuCoin\Futures\SDK\PublicApi\Time;

// Require PHP 7.1+ and Swoole 2.1.2+
// Require running in cli mode

go(function () {
    $api = new Time(null, new SwooleHttp);
    $timestamp = $api->timestamp();
    var_dump($timestamp);
});

go(function () {
    // Auth version v2 (recommend)
    $auth = new Auth('key', 'secret', 'passphrase', Auth::API_KEY_VERSION_V2);
    // Auth version v1
    // $auth = new Auth('key', 'secret', 'passphrase');
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
<summary>KuCoin\Futures\SDK\PrivateApi\Account</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\Account::getOverview() | YES | https://docs.kucoin.com/futures/#account |
| KuCoin\Futures\SDK\PrivateApi\Account::getTransactionHistory() | YES | https://docs.kucoin.com/futures/#get-transaction-history |
| KuCoin\Futures\SDK\PrivateApi\Account::transferIn() | YES |`deprecated`|
| KuCoin\Futures\SDK\PrivateApi\Account::transferOut() | YES | `deprecated` https://docs.kucoin.com/futures/#transfer-funds-to-kucoin-main-account |
| KuCoin\Futures\SDK\PrivateApi\Account::transferOutV2() | YES | https://docs.kucoin.com/futures/#transfer-funds-to-kucoin-main-account-2 |
| KuCoin\Futures\SDK\PrivateApi\Account::cancelTransferOut() | YES | https://docs.kucoin.com/futures/#cancel-transfer-out-request |
| KuCoin\Futures\SDK\PrivateApi\Account::getTransferList() | YES | https://docs.kucoin.com/futures/#get-transfer-out-request-records |
</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\Deposit</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\Deposit::getAddress() | YES | https://docs.kucoin.com/futures/#get-deposit-address |
| KuCoin\Futures\SDK\PrivateApi\Deposit::getDeposits() | YES | https://docs.kucoin.com/futures/#get-deposit-list |

</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\Fill</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\Fill::getFills() | YES | https://docs.kucoin.com/futures/#get-fills |
| KuCoin\Futures\SDK\PrivateApi\Fill::getRecentList() | YES | https://docs.kucoin.com/futures/#recent-fills |
</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\Order</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\Order::create() | YES | https://docs.kucoin.com/futures/#place-an-order |
| KuCoin\Futures\SDK\PrivateApi\Order::cancel() | YES | https://docs.kucoin.com/futures/#cancel-an-order |
| KuCoin\Futures\SDK\PrivateApi\Order::batchCancel() | YES | https://docs.kucoin.com/futures/#limit-order-mass-cancelation |
| KuCoin\Futures\SDK\PrivateApi\Order::stopOrders() | YES | https://docs.kucoin.com/futures/#stop-order-mass-cancelation |
| KuCoin\Futures\SDK\PrivateApi\Order::getList() | YES | https://docs.kucoin.com/futures/#get-order-list |
| KuCoin\Futures\SDK\PrivateApi\Order::getStopOrders() | YES | https://docs.kucoin.com/futures/#get-untriggered-stop-order-list |
| KuCoin\Futures\SDK\PrivateApi\Order::getRecentDoneOrders() | YES | https://docs.kucoin.com/futures/#get-list-of-orders-completed-in-24h |
| KuCoin\Futures\SDK\PrivateApi\Order::getDetail() | YES | https://docs.kucoin.com/futures/#get-details-of-a-single-order |
| KuCoin\Futures\SDK\PrivateApi\Order::getOpenOrderStatistics() | YES | https://docs.kucoin.com/futures/#active-order-value-calculation |

</details>
<details>
<summary>KuCoin\Futures\SDK\PrivateApi\Position</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\Position::getList() | YES | https://docs.kucoin.com/futures/#get-position-list |
| KuCoin\Futures\SDK\PrivateApi\Position::getDetail() | YES | https://docs.kucoin.com/futures/#get-position-details |
| KuCoin\Futures\SDK\PrivateApi\Position::changeAutoAppendStatus() | YES | https://docs.kucoin.com/futures/#enable-disable-of-auto-deposit-margin |
| KuCoin\Futures\SDK\PrivateApi\Position::marginAppend() | YES | https://docs.kucoin.com/futures/#add-margin-manually |
</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\WebSocketFeed</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\WebSocketFeed::getPublicServer() | NO | https://docs.kucoin.com/futures/#apply-connect-token |
| KuCoin\Futures\SDK\PrivateApi\WebSocketFeed::getPrivateServer() | YES | https://docs.kucoin.com/futures/#apply-connect-token |
| KuCoin\Futures\SDK\PrivateApi\WebSocketFeed::subscribePublicChannel() | NO | https://docs.kucoin.com/futures/#public-channels |
| KuCoin\Futures\SDK\PrivateApi\WebSocketFeed::subscribePublicChannels() | NO | https://docs.kucoin.com/futures/#public-channels |
| KuCoin\Futures\SDK\PrivateApi\WebSocketFeed::subscribePrivateChannel() | YES | https://docs.kucoin.com/futures/#private-channels |
| KuCoin\Futures\SDK\PrivateApi\WebSocketFeed::subscribePrivateChannels() | YES | https://docs.kucoin.com/futures/#private-channels |

</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\Withdrawal</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\Withdrawal::getQuotas() | YES | https://docs.kucoin.com/futures/#get-withdrawal-limit |
| KuCoin\Futures\SDK\PrivateApi\Withdrawal::getList() | YES | https://docs.kucoin.com/futures/#get-withdrawal-list |
| KuCoin\Futures\SDK\PrivateApi\Withdrawal::apply() | YES | https://docs.kucoin.com/futures/#withdraw-funds |
| KuCoin\Futures\SDK\PrivateApi\Withdrawal::cancel() | YES | https://docs.kucoin.com/futures/#cancel-withdrawal |

</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\RiskLimitLevel</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\Withdrawal::changeRiskLimitLevel() | YES | https://docs.kucoin.com/futures/#adjust-risk-limit-level |
</details>

<details>
<summary>KuCoin\Futures\SDK\PublicApi\Symbol</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PublicApi\Symbol::getTicker() | NO | https://docs.kucoin.com/futures/#get-ticker |
| KuCoin\Futures\SDK\PublicApi\Symbol::getLevel2Snapshot() | NO | https://docs.kucoin.com/futures/#get-full-order-book-level-2 |
| KuCoin\Futures\SDK\PublicApi\Symbol::getLevel3Snapshot() | NO | https://docs.kucoin.com/futures/#get-full-order-book-level-3 |
| KuCoin\Futures\SDK\PublicApi\Symbol::getV2Level3Snapshot() | NO | https://docs.kucoin.com/futures/#get-full-order-book-level-3-v2 |
| KuCoin\Futures\SDK\PublicApi\Symbol::getLevel2Message() | NO | https://docs.kucoin.com/futures/##level-2-pulling-messages |
| KuCoin\Futures\SDK\PublicApi\Symbol::getLevel3Message() | NO | https://docs.kucoin.com/futures/##level-3-pulling-messages |
| KuCoin\Futures\SDK\PublicApi\Symbol::getTradeHistory() | NO | https://docs.kucoin.com/futures/#get-trade-histories |
| KuCoin\Futures\SDK\PublicApi\Symbol::getKLines() | NO | https://docs.kucoin.com/futures/?lang=en_US#get-k-line-data-of-contract |
| KuCoin\Futures\SDK\PublicApi\Symbol::getLevel2Depth20 | NO | https://docs.kucoin.com/futures/cn/#level-2-2 |
| KuCoin\Futures\SDK\PublicApi\Symbol::getLevel2Depth100 | NO | https://docs.kucoin.com/futures/cn/#level-2-2 |
| KuCoin\Futures\SDK\PublicApi\Symbol::getRiskLimitLevel | NO | https://docs.kucoin.com/futures/#obtain-futures-risk-limit-level |

</details>

<details>
<summary>KuCoin\Futures\SDK\PublicApi\Time</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PublicApi\Time::timestamp() | NO | https://docs.kucoin.com/futures/#server-time |

</details>

<details>
<summary>KuCoin\Futures\SDK\PublicApi\Status</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PublicApi\Status::status() | NO | https://docs.kucoin.com/futures/#get-the-service-status |

</details>

## Run tests
> Modify your API key in `phpunit.xml` first.

```shell
# Add your API configuration items into the environmental variable first
export API_BASE_URI=https://api-futures.kucoin.com
export API_KEY=key
export API_SECRET=secret
export API_PASSPHRASE=passphrase
export API_KEY_VERSION=2
export API_DEBUG_MODE=1

composer test
```

## License

[MIT](LICENSE)
