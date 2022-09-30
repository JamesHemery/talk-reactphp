<?php

use React\EventLoop\Loop;
use React\Stream\ReadableResourceStream;
use React\Stream\WritableResourceStream;

require __DIR__ . '/vendor/autoload.php';

$loop = Loop::get();

$readable = new ReadableResourceStream(fopen('file.txt', 'r'), $loop, 100);
$output = new WritableResourceStream(STDOUT, $loop);

$readable->on('data', function($data) use ($output){
    $output->write('Chunk : ' . $data . PHP_EOL);
});

$readable->on('end', function() use ($output) {
    $output->write('Fin');
    $output->end();
});
