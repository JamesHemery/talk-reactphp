<?php

use React\EventLoop\Loop;

require __DIR__ . '/vendor/autoload.php';

Loop::addReadStream(STDIN, function ($stream) {
    echo 'Vous avez dit: ' . fread($stream, 1024);
});
