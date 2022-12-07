<?php

declare(strict_types=1);

use App\Dir;
use App\File;
use App\Terminal;

require_once 'vendor/autoload.php';

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

$rootDir = new \App\Dir('/');

$terminal = new Terminal();

foreach ($commands as $command) {
    if ($command[0] === 'cd') {
        $terminal->cd($command[1]);
    } elseif ($command[0] === 'ls') {
        foreach ($terminal->ls($command[1]) as $item) {
            $currentDir = $rootDir;
            foreach ($terminal->getContext() as $dirName) {
                if ($currentDir->getDirByName($dirName) === null) {
                    $newDir = new Dir($dirName);
                    $currentDir->addDir($newDir);
                    $currentDir = $newDir;
                } else {
                    $currentDir = $currentDir->getDirByName($dirName);
                }
            }

            switch ($item::class) {
                case Dir::class:
                    $currentDir->addDir($item);
                    break;
                case File::class:
                    $currentDir->addFile($item);
                    break;
                default:
                    throw new Exception('Unexpected item!');
            }
        }
    }
}

function printOffset(int $numOfLoops)
{
    for ($i = 0; $i < $numOfLoops; $i++) {
        echo "  ";
    }
}

function printStructure(Dir $dir, int $offset = 0)
{
    printOffset($offset);
    print_r('- ' . $dir->getName() . ' (dir, ' . $dir->getSize() . ')');
    echo "\n";
    foreach ($dir->getContent() as $item) {
        switch ($item::class) {
            case Dir::class:
                printStructure($item, $offset + 1);
                break;
            case File::class:
                printOffset($offset + 1);
                print_r('- ' . $item->getName() . ' (file, ' . $item->getSize() . ')');
                echo "\n";
                break;
        }
    }
}

printStructure($rootDir);
echo "\n";
echo "\n";

print_r($rootDir->getName() . ' - ' . $rootDir->getSize());
echo "\n";

$sum = 0;
foreach ($rootDir->getDirs(true) as $dir) {
    print_r($dir->getName() . ' - ' . $dir->getSize());
    echo "\n";

    if ($dir->getSize() <= 100000) {
        $sum += $dir->getSize();
    }
}

print_r($sum);


