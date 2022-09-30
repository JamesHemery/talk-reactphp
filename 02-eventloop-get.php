<?php

use React\EventLoop\Loop;

require __DIR__ . '/vendor/autoload.php';

$loop = Loop::get(); // Factory::create();

$i = 0;
$loop->addPeriodicTimer(2, function ($timer) use ($loop, &$i) {
    echo 'Alors, comment ça va ?' . PHP_EOL;

    if ($i++ === 2) {
        $loop->cancelTimer($timer);
    }
});

$loop->addTimer(1, function () {
    echo 'Hello AFUP Tours' . PHP_EOL;
});