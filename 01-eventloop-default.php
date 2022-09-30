<?php

use React\EventLoop\Loop;

require __DIR__ . '/vendor/autoload.php';

// S'execute toutes les x secondes

$i = 0;
Loop::addPeriodicTimer(2, function ($timer) use (&$i) {
    echo 'Alors, comment ça va ?' . PHP_EOL;

    if ($i++ === 2) {
        Loop::cancelTimer($timer);
    }
});

// Ne s'executera qu'une fois

Loop::addTimer(1, function () {
    echo 'Hello AFUP Tours' . PHP_EOL;
});

// Basé sur les ticks

Loop::futureTick(function(){
    echo '...';
});