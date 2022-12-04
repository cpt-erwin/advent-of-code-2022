<?php

declare(strict_types=1);

use App\Interval;

require_once 'vendor/autoload.php';

$input = file_get_contents('input');
$inputIntervalPairs = preg_split("/\n/", $input);

$intervals = [];
foreach ($inputIntervalPairs as $inputIntervalPair) {
    $rawIntervals = explode(',', $inputIntervalPair);
    $pair = [];
    foreach ($rawIntervals as $rawInterval) {
        $intervalBorders = explode('-', $rawInterval);
        $pair[] = new Interval(
            (int)$intervalBorders[0],
            (int)$intervalBorders[1],
        );
    }

    $intervals[] = $pair;
}

$sum = 0;
foreach ($intervals as $pair) {
    $fullContainment = Interval::fullyContained(
        $pair[0],
        $pair[1]
    );

    if (abs($fullContainment) > 0) {
        $sum++;
    }
}

print_r($sum);