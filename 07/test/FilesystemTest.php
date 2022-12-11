<?php

declare(strict_types=1);

namespace Test;

use App\Filesystem;

class FilesystemTest extends \PHPUnit\Framework\TestCase
{
    public function testGetDirFromContext()
    {
        $filesystem = new Filesystem();
        $dir = $filesystem->getDirFromContext(['root', 'a', 'b']);
        self::assertEquals(
            'b',
            $dir->getName()
        );
    }
}