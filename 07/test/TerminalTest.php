<?php

declare(strict_types=1);

namespace Test;

use App\Dir;
use App\File;
use App\Terminal;

class TerminalTest extends \PHPUnit\Framework\TestCase
{
    public function testSingleCdCommand()
    {
        $terminal = new Terminal();
        $terminal->cd('/');

        self::assertEquals(
            ['/'],
            $terminal->getContext()
        );
    }

    public function testMultipleCdCommand()
    {
        $terminal = new Terminal();
        $terminal->cd('/');
        $terminal->cd('a');
        $terminal->cd('b');
        $terminal->cd('c');
        $terminal->cd('..');
        $terminal->cd('d');
        $terminal->cd('e');
        $terminal->cd('..');
        $terminal->cd('..');
        $terminal->cd('f');

        self::assertEquals(
            ['/', 'a', 'b', 'f'],
            $terminal->getContext()
        );
    }

    public function testLs()
    {
        $structure = [
            'dir jmtrrrp',
            'dir jssnn',
            '11968 pcccp',
            '51021 crlq.lrj',
            '186829 dhcrzvbr.wmn',
        ];

        $terminal = new Terminal();
        $terminal->cd('root');
        $terminal->ls($structure);

        $output = $terminal->getFilesystem()->getDirFromContext($terminal->getContext())->getContent();

        foreach ($output as $index => $item) {
            $record = explode(' ', $structure[$index]);

            if($record[0] === 'dir') {
                self::assertInstanceOf(
                    Dir::class,
                    $item
                );
            } else {
                self::assertInstanceOf(
                    File::class,
                    $item
                );
            }

            self::assertEquals(
                $record[1],
                $item->getName()
            );
        }
    }
}