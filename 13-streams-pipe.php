<?php

use React\EventLoop\Loop;
use React\Stream\ReadableResourceStream;
use React\Stream\ThroughStream;
use React\Stream\WritableResourceStream;

require __DIR__ . '/vendor/autoload.php';

$loop = Loop::get();

$out = new WritableResourceStream(STDOUT, $loop);
$in = new ReadableResourceStream(STDIN, $loop);

$uppercase = new ThroughStream(function($data){
    return strtoupper($data);
});

$in->pipe($uppercase)->pipe($out);