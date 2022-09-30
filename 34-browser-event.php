<?php

use React\EventLoop\Loop;
use React\Socket\ConnectionInterface;
use React\Socket\SocketServer;

require __DIR__ . '/vendor/autoload.php';

$loop = Loop::get();

$listeners = [];

Loop::addPeriodicTimer(1, function () use (&$listeners) {
    echo count($listeners) . PHP_EOL;
});

$chat = new SocketServer('127.0.0.1:8010');
$chat->on('connection', function (ConnectionInterface $connection) use ($chat, &$listeners) {
    $connection->on('data', function ($data) use ($connection, $chat, &$listeners) {
        if (empty(trim($data))){
            return;
        }

        foreach ($listeners as $listener) {
            $listener->write("data: " . $data . "\r\n\r\n");
        }
    });
});

$http = new SocketServer('127.0.0.1:8080');
$http->on('connection', function (ConnectionInterface $connection) use (&$listeners) {
    $connection->once('data', function ($data) use ($connection, &$listeners) {
        if (str_starts_with($data, 'GET /stream')) {
            $connection->write("HTTP/1.1 200 OK\r\nContent-Type: text/event-stream\r\n\r\n");
            $listeners[] = $connection;
            return;
        }

        $body = file_get_contents('index.html');
        $connection->end("HTTP/1.1 200 OK\r\nContent-Length: " . strlen($body) . "\r\nConnection: close\r\n\r\n" . $body);
    });

    $connection->on('close', function () use ($connection, &$listeners) {
        $listeners = array_filter($listeners, fn($item) => $item !== $connection);
    });
});

