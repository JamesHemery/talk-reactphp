<?php

use React\Socket\ConnectionInterface;
use React\Socket\SocketServer;

require __DIR__ . '/vendor/autoload.php';

$http = new SocketServer('127.0.0.1:8080');
$http->on('connection', function (ConnectionInterface $connection) {
    $connection->once('data', function () use ($connection) {
        $body = '<h1>Hello AFUP Tours</h1>';
        $connection->end("HTTP/1.1 200 OK\r\nContent-Length: " . strlen($body) . "\r\nConnection: close\r\n\r\n" . $body);
    });
});

