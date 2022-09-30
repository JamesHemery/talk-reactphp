<?php

use React\EventLoop\Loop;
use React\Socket\ConnectionInterface;
use React\Socket\SocketServer;
use React\Stream\WritableResourceStream;

require __DIR__ . '/vendor/autoload.php';

$loop = Loop::get();

$socket = new SocketServer('127.0.0.1:8010');

$out = new WritableResourceStream(STDOUT, $loop);

$socket->on('connection', function (ConnectionInterface $connection) use ($out) {
    $connection->on('data', function ($data) use ($connection, $out) {
        $out->write('Nouveau message : ' . $data);
    });
});