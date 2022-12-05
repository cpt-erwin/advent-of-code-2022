<?php

declare(strict_types=1);

namespace Test;

use App\Stack;

class StackTest extends \PHPUnit\Framework\TestCase
{
    public function testPush()
    {
        $stack = new Stack();

        $stack->push(
            'A'
        );

        $stack->push(
                'B',
                'C',
        );

        self::assertEquals(
            3,
            $stack->getSize()
        );
    }

    public function testPop()
    {
        $stack = new Stack();

        $stack->push(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
        );

        $secondStack = $stack->pop(2);

        self::assertEquals(
            4,
            $stack->getSize()
        );

        self::assertEquals(
            2,
            $secondStack->getSize()
        );
    }
}