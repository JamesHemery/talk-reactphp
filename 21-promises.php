<?php

use React\Promise\Deferred;
use function React\Promise\Timer\sleep;

require __DIR__ . '/vendor/autoload.php';

function longFn()
{
    $deferred = new Deferred();

    sleep(1)->then(function() use ($deferred){
        $deferred->resolve('success');
        //$deferred->reject('API unreachable');
    });

    return $deferred->promise();
}

longFn()->then(
    function ($value) {
        echo $value . PHP_EOL;
    },
    function ($reason) {
        echo 'Erreur : ' . $reason . PHP_EOL;
    }
);

echo 'Autre chose...' . PHP_EOL;