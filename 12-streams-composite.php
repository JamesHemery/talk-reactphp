<?php

use React\EventLoop\Loop;
use React\Stream\CompositeStream;
use React\Stream\ReadableResourceStream;
use React\Stream\WritableResourceStream;

require __DIR__ . '/vendor/autoload.php';

$loop = Loop::get();

$out = new WritableResourceStream(STDOUT, $loop);
$in = new ReadableResourceStream(STDIN, $loop);

$composite = new CompositeStream($in, $out);

$composite->on('data', function($data) use ($composite) {
   $composite->write('Vous avez dit : ' . $data);
});