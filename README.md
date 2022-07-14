# PHP SDK for KuCoin Futures API 2.0

> The detailed document [https://docs.kucoin.com/futures/new/](https://docs.kucoin.com/futures/new/), in order to receive the latest API change notifications, please `Watch` this repository.

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
composer require "kucoin/kucoin-futures-php-sdk:~2.0.0"
```

## Usage

### Choose environment

| Environment | BaseUri |
|    -------- | -------- |
| *Production* | `https://api-v2-futures.kucoin.com(DEFAULT)` |
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
use KuCoin\Futures\SDK\PrivateApi\V2\Account;
use KuCoin\Futures\SDK\Exceptions\HttpException;
use KuCoin\Futures\SDK\Exceptions\BusinessException;

// Auth version v2 (recommend)
$auth = new Auth('key', 'secret', 'passphrase', Auth::API_KEY_VERSION_V2);
// Auth version v1
// $auth = new Auth('key', 'secret', 'passphrase');

$api = new Account($auth);

try {
    $result = $api->getV2Overview();
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
    ['topic' => '/futuresMarket/ticker:KCS-BTC'], // Subscribe multiple channels
    ['topic' => '/futuresMarket/ticker:ETH-BTC'],
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
use KuCoin\Futures\SDK\PrivateApi\V2\Order;
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
                $result = $api->createV2($order);
                var_dump($result);
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        });
    }
});
```

### API list

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\V2\Account</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\V2\Account::getV2Overview() | YES | https://docs.kucoin.com/futures/new/#get-account-overview |
| KuCoin\Futures\SDK\PrivateApi\V2\Account::getV2TransactionHistory | YES | https://docs.kucoin.com/futures/new/#query-fund-record |
| KuCoin\Futures\SDK\PrivateApi\V2\Account::transferOutV2() | YES | https://docs.kucoin.com/futures/new/#transfer-out-to-kucoin-main-trading-account |
| KuCoin\Futures\SDK\PrivateApi\V2\Account::getV2TransferList() | YES | https://docs.kucoin.com/futures/new/#query-transfer-out-request-record |
| KuCoin\Futures\SDK\PrivateApi\V2\Account::transferInV2() | YES | https://docs.kucoin.com/futures/new/#fund-transfer-into-futures-account |
| KuCoin\Futures\SDK\PrivateApi\V2\Account::getV2FundingHistory() | YES |  |
</details>


<details>
<summary>KuCoin\Futures\SDK\PrivateApi\V2\UserConfig</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\V2\UserConfig::getV2Leverage() | YES | https://docs.kucoin.com/futures/new/#get-the-user-s-global-leverage |
| KuCoin\Futures\SDK\PrivateApi\V2\UserConfig::getV2Leverages() | YES | https://docs.kucoin.com/futures/new/#get-user-global-leverage-all-contracts |
| KuCoin\Futures\SDK\PrivateApi\V2\UserConfig::adjustLeveragesV2() | YES | https://docs.kucoin.com/futures/new/#modify-the-user-s-global-leverage |
| KuCoin\Futures\SDK\PrivateApi\V2\UserConfig::changeV2AutoAppendStatus() | YES | https://docs.kucoin.com/futures/new/#modify-the-user-39-s-auto-deposit-margin-status |
</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\V2\Order</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::createV2() | YES | https://docs.kucoin.com/futures/new/#order-placement |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::cancelV2() | YES | https://docs.kucoin.com/futures/new/#single-order-cancellation |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::batchV2Cancel() | YES | https://docs.kucoin.com/futures/new/#batch-order-cancellation |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::getV2HistoricalTrades() | YES | https://docs.kucoin.com/futures/new/#query-transaction-records |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::getV2Detail() | YES | https://docs.kucoin.com/futures/new/#query-individual-order-s-details |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::getV2ActiveOrders() | YES | https://docs.kucoin.com/futures/new/#query-active-orders |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::getV2AllActiveOrders() | YES | https://docs.kucoin.com/futures/new/#query-all-active-orders |
| KuCoin\Futures\SDK\PrivateApi\V2\Order::getV2List() | YES | https://docs.kucoin.com/futures/new/#query-historical-orders |
</details>

<details>
<summary>KuCoin\Futures\SDK\PrivateApi\V2\Position</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PrivateApi\V2\Position::getV2List() | YES | https://docs.kucoin.com/futures/new/#get-the-position-of-all-contracts |
| KuCoin\Futures\SDK\PrivateApi\V2\Position::getV2Detail() | YES | https://docs.kucoin.com/futures/new/#get-the-position-of-a-contract |
| KuCoin\Futures\SDK\PrivateApi\V2\Position::marginV2Append() | YES | https://docs.kucoin.com/futures/new/#increase-position-margin |
| KuCoin\Futures\SDK\PrivateApi\V2\Position::getV2ClosePnLHistory() | YES | https://docs.kucoin.com/futures/new/#position-pnl-history |
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
<summary>KuCoin\Futures\SDK\PublicApi\V2\Contract</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PublicApi\V2\Contract::getV2List() | NO | https://docs.kucoin.com/futures/new/#get-the-information-for-all-open-contracts|
| KuCoin\Futures\SDK\PublicApi\V2\Contract::getV2Detail() | NO | https://docs.kucoin.com/futures/new/#get-a-certain-contract|
| KuCoin\Futures\SDK\PublicApi\V2\Contract::getV2RiskLimitLevel() | NO | https://docs.kucoin.com/futures/new/#get-contract-s-risk-limit-list|
| KuCoin\Futures\SDK\PublicApi\V2\Contract::getV2KLines() | NO | https://docs.kucoin.com/futures/new/#get-the-contract-s-k-line-data|
| KuCoin\Futures\SDK\PublicApi\V2\Contract::getV2FundingRate() | NO | https://docs.kucoin.com/futures/new/#query-funding-rate-list|
| KuCoin\Futures\SDK\PublicApi\V2\Contract::getV2MarkPrice() | NO | https://docs.kucoin.com/futures/new/#get-the-contract-s-mark-price|

</details>


<details>
<summary>KuCoin\Futures\SDK\PublicApi\V2\Symbol</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| KuCoin\Futures\SDK\PublicApi\V2\Symbol::getV2OrderBook() | NO | https://docs.kucoin.com/futures/new/#get-order-book |
| KuCoin\Futures\SDK\PublicApi\V2\Symbol::getV2Ticker() | NO | https://docs.kucoin.com/futures/new/#best-maker |
| KuCoin\Futures\SDK\PublicApi\V2\Symbol::getV2TickerPrice() | NO | https://docs.kucoin.com/futures/new/#get-the-latest-transaction-price |
| KuCoin\Futures\SDK\PublicApi\V2\Symbol::getV2TradeHistory() | NO | https://docs.kucoin.com/futures/new/#get-most-recent-record |

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
