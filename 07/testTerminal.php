<?php

declare(strict_types=1);

use App\Dir;
use App\File;
use App\Terminal;

require_once 'vendor/autoload.php';

$terminal = new Terminal();
$terminal->cd('/');
$terminal->cd('a');
$terminal->cd('b');
$terminal->cd('..');
$terminal->cd('c');
$terminal->ls([
    '29116 f',
    '2557 g'
]);

print_r($terminal->getContext());
var_dump($terminal->getStructure());


