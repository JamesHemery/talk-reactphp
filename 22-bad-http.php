<?php

require __DIR__ . '/vendor/autoload.php';

for ($i = 0; $i < 30; $i++) {
    $body = file_get_contents('https://catfact.ninja/fact');
    $data = json_decode($body, true);
    echo $data['fact'] . PHP_EOL;
}

echo 'Finished';