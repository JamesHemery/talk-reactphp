<?php

use React\EventLoop\Loop;

require __DIR__ . '/vendor/autoload.php';

Loop::addSignal(SIGINT, $func = function () use (&$func) {
    echo 'Au revoir !';
    Loop::removeSignal(SIGINT, $func);
});
