<?php

declare(strict_types=1);

namespace Test;

use App\Dir;
use App\File;

class DirTest extends \PHPUnit\Framework\TestCase
{
    public function testSingleFileAddition()
    {
        $file = new File(
            'testFile.txt',
            5000
        );

        $dir = new Dir('testDir');
        $dir->addFile(
            $file
        );

        self::assertContains(
            $file,
            $dir->getContent()
        );
    }

    public function testMultipleFilesAddition()
    {
        $files = [
            new File(
                'one',
                1000
            ),
            new File(
                'two',
                2000
            ),
            new File(
                'three',
                3000
            ),
        ];

        $dir = new Dir('testDir');

        foreach ($files as $file) {
            $dir->addFile(
                $file
            );
        }

        foreach ($files as $file) {
            self::assertContains(
                $file,
                $dir->getContent()
            );
        }
    }

    public function testSingleDirAddition()
    {
        $innerDir = new Dir(
            'testDir'
        );

        $dir = new Dir('testDir');
        $dir->addDir(
            $innerDir
        );

        self::assertContains(
            $innerDir,
            $dir->getContent()
        );
    }

    public function testMultipleDirsAddition()
    {
        $innerDirs = [
            new Dir(
                'dirOne'
            ),
            new Dir(
                'secondDir'
            ),
            new Dir(
                'anotherDir'
            ),
        ];

        $dir = new Dir('testDir');

        foreach ($innerDirs as $innerDir) {
            $dir->addDir(
                $innerDir
            );
        }

        foreach ($innerDirs as $innerDir) {
            self::assertContains(
                $innerDir,
                $dir->getContent()
            );
        }
    }

    public function testSizeForFilesOnly()
    {
        $files = [
            new File(
                'one',
                1000
            ),
            new File(
                'two',
                2000
            ),
            new File(
                'three',
                3000
            ),
        ];

        $dir = new Dir('testDir');

        foreach ($files as $file) {
            $dir->addFile(
                $file
            );
        }

        self::assertEquals(
            6000,
            $dir->getSize()
        );
    }

    public function testSizeForInnerDirOnly()
    {
        $files = [
            new File(
                'one',
                1000
            ),
            new File(
                'two',
                2000
            ),
            new File(
                'three',
                4000
            ),
        ];

        $innerDir = new Dir('innerDir');

        foreach ($files as $file) {
            $innerDir->addFile(
                $file
            );
        }

        $dir = new Dir('testDir');
        $dir->addDir(
            $innerDir
        );

        self::assertEquals(
            7000,
            $dir->getSize()
        );
    }

    public function testSizeForRandomContent()
    {
        $expectedTotalSize = 0;

        $dir = new Dir('testDir');
        for ($i = 0; $i < random_int(2, 10); $i++) {
            $innerDir = new Dir(uniqid());
            for ($i = 0; $i < random_int(0, 20); $i++) {
                $file = new File(
                    uniqid(),
                    random_int(0, 999999)
                );
                $innerDir->addFile($file);

                $expectedTotalSize += $file->getSize();
            }

            $dir->addDir(
                $innerDir
            );
        }

        self::assertEquals(
            $expectedTotalSize,
            $dir->getSize()
        );
    }

    public function testGetDirsRecursively()
    {
        $numberOfDirs = 0;

        $dir = new Dir('root');
        for ($i = 0; $i < random_int(2, 10); $i++) {
            $subDir = new Dir(uniqid());
            for ($i = 0; $i < random_int(2, 10); $i++) {
                $subSubDir = new Dir(uniqid());
                $subDir->addDir(
                    $subSubDir
                );
                $numberOfDirs++;
            }
            $dir->addDir(
                $subDir
            );
            $numberOfDirs++;
        }

        self::assertCount(
            $numberOfDirs,
            $dir->getDirs(true)
        );
    }

    public function testGetDirByName()
    {
        $dir = new Dir('/');
        $dir->addDir(new Dir('1'));
        $dir->addDir(new Dir('test'));
        $dir->addDir(new Dir('dir'));
        $dir->addDir(new Dir('four'));
        $dir->addDir(new Dir('end'));

        self::assertInstanceOf(
            Dir::class,
            $dir->getDirByName('four')
        );

        self::assertNull(
            $dir->getDirByName('nonExistingDir')
        );
    }
}