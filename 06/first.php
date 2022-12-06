<?php

declare(strict_types=1);

use App\Marker;

require_once 'vendor/autoload.php';

$sequence = file_get_contents('input');

$marker = Marker::createFromString(
    $sequence,
    4
);

print_r($marker->getContent());
print_r(PHP_EOL);
print_r($marker->getOffset() + strlen($marker->getContent()));