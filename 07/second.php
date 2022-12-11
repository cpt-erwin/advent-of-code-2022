<?php

declare(strict_types=1);

use App\Terminal;

require_once 'vendor/autoload.php';

const DISK_SIZE = 70000000;
const UPDATE_SIZE = 30000000;

$commandList = file_get_contents('input');
$commandList = preg_split("/\n/", $commandList);

$commands = [];
foreach ($commandList as $command) {
    $command = trim($command);
    if (str_starts_with($command, '$')) {
        $command = str_replace('$ ', '', $command);
        $data = explode(' ', $command);
        $commands[] = [
            $data[0],
            array_key_exists(1, $data) ? $data[1] : [],
        ];
    } else {
        $commands[array_key_last($commands)][1][] = $command;
    }
}

$terminal = new Terminal();
foreach ($commands as $command) {
    switch ($command[0]) {
        case 'cd':
            $terminal->cd($command[1]);
            break;

        case 'ls':
            $terminal->ls($command[1]);
            break;

        default:
            throw new Exception('Unexpected command ' . $command[1]);
    }
}

$rootDir = $terminal->getFilesystem()->getDirFromContext(['/']);

$usedSpace = $rootDir->getSize();
$unusedSpace = DISK_SIZE - $usedSpace;
$requiredSpace = UPDATE_SIZE - $unusedSpace;

$dirSizes = [];
foreach ($terminal->getFilesystem()->getDirectories() as $key => $dir) {
    if ($dir->getSize() > $requiredSpace) {
        $dirSizes[$key] = $dir->getSize();
    }
}
sort($dirSizes);
print_r($dirSizes[0]);

