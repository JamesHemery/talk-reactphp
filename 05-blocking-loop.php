<?php

use React\EventLoop\Loop;

require __DIR__ . '/vendor/autoload.php';

Loop::addTimer(1, function ()  {
    echo 'Après 1 seconde...';
});

while (true) {
    //
}