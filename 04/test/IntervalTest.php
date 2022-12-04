<?php

declare(strict_types=1);

namespace Test;

use App\Interval;

class IntervalTest extends \PHPUnit\Framework\TestCase
{
    public function testSingleValueInterval()
    {
        $interval = new Interval(3,3);
        self::assertEquals(
            1,
            $interval->getSize()
        );
    }

    public function testMultipleValueInterval()
    {
        $interval = new Interval(3,9);
        self::assertEquals(
            7,
            $interval->getSize()
        );
    }

    public function testFullyContainedExclusion()
    {
        $interval1 = new Interval(1,3);
        $interval2 = new Interval(6,9);
        self::assertEquals(
            0,
            Interval::fullyContained(
                $interval1,
                $interval2
            )
        );
    }

    public function testFullyContainedDuplicate()
    {
        $interval1 = new Interval(1,3);
        $interval2 = new Interval(1,3);
        self::assertEquals(
            2,
            Interval::fullyContained(
                $interval1,
                $interval2
            )
        );
    }

    public function testFullyContainedSecondInFirst()
    {
        $interval1 = new Interval(1,9);
        $interval2 = new Interval(3,6);
        self::assertEquals(
            -1,
            Interval::fullyContained(
                $interval1,
                $interval2
            )
        );
    }

    public function testFullyContainedFirstInSecond()
    {
        $interval1 = new Interval(3,6);
        $interval2 = new Interval(1,9);
        self::assertEquals(
            1,
            Interval::fullyContained(
                $interval1,
                $interval2
            )
        );
    }

    public function testIntersectsFalse()
    {
        $interval1 = new Interval(1,3);
        $interval2 = new Interval(6,9);
        self::assertFalse(
            Interval::intersects(
                $interval1,
                $interval2
            )
        );
    }

    public function testIntersectsTrue()
    {
        $interval1 = new Interval(1,7);
        $interval2 = new Interval(5,9);
        self::assertTrue(
            Interval::intersects(
                $interval1,
                $interval2
            )
        );
    }
}