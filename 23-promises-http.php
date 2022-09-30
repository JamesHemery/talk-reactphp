<?php

use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use function React\Promise\all;

require __DIR__ . '/vendor/autoload.php';

$browser = new Browser();

$promises = [];

for ($i = 0; $i < 30; $i++) {
    $promises[] = $browser->get('https://catfact.ninja/fact')->then(function(ResponseInterface $response){
        $data = json_decode($response->getBody(), true);
        echo $data['fact'] . PHP_EOL;
    });
}

all($promises)->then(function(){
    echo 'Finished';
});