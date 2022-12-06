<?php

declare(strict_types=1);

namespace Test;

use App\Marker;

class MarkerTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateFromString()
    {
        $marker = Marker::createFromString(
            'mjqjpqmgbljsphdztnvjfqwrcgsmlb',
            4
        );

        self::assertEquals(
            'jpqm',
            $marker->getContent()
        );
    }

    public function testOffset()
    {
        $marker = Marker::createFromString(
            'nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg',
            4
        );

        self::assertEquals(
            10,
            $marker->getOffset() + strlen($marker->getContent())
        );
    }
}