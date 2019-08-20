<?php

namespace KuMEX\SDK\Exceptions;

class NoAvailableWebSocketServerException extends \Exception
{
    protected $message = 'No available websocket server';
}