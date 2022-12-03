<?php

declare(strict_types=1);

namespace Test;

use App\Item;

class ItemTest extends \PHPUnit\Framework\TestCase
{
    public function testGetPriority()
    {
        $this->assertEquals(
            1,
            Item::getPriority('a')
        );
    }
}