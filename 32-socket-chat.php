<?php

use React\Socket\ConnectionInterface;
use React\Socket\LimitingServer;
use React\Socket\SocketServer;

require __DIR__ . '/vendor/autoload.php';

$socket = new SocketServer('127.0.0.1:8010');

$socket = new LimitingServer($socket, null);

$socket->on('connection', function (ConnectionInterface $connection) use ($socket) {
    foreach ($socket->getConnections() as $c) {
        if ($c === $connection) {
            continue;
        }

        $c->write($connection->getLocalAddress() . ' s\'est connecté' . PHP_EOL);
    }

    $connection->on('data', function ($data) use ($connection, $socket) {
        if ($data === '') {
            return;
        }

        $data = $connection->getLocalAddress() . ' à dit : ' . $data . PHP_EOL;
        foreach ($socket->getConnections() as $c) {
            $c->write($data);
        }
    });

    $connection->on('close', function () use ($connection, $socket) {
        foreach ($socket->getConnections() as $c) {
            if ($c === $connection) {
                continue;
            }

            $c->write($connection->getLocalAddress() . ' s\'est déconnecté' . PHP_EOL);
        }
    });
});