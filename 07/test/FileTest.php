<?php

declare(strict_types=1);

namespace Test;

use App\File;

class FileTest extends \PHPUnit\Framework\TestCase
{
    public function testSizeGetter()
    {
        $file = new File(
            'test.txt',
            5000
        );

        self::assertEquals(
            5000,
            $file->getSize()
        );
    }

    public function testNameGetter()
    {
        $file = new File(
            'test.txt',
            5000
        );

        self::assertEquals(
            'test.txt',
            $file->getName()
        );
    }
}