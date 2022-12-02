<?php

declare(strict_types=1);

namespace Test;

use App\CircularIndexedList;

class CircularIndexedListTest extends \PHPUnit\Framework\TestCase
{
    public function testPush()
    {
        $list = new CircularIndexedList();

        $list->push('x');
        $list->push(1);
        $list->push(null);

        $this->assertEquals(3, $list->getSize());
    }

    public function testCurrent()
    {
        $list = new CircularIndexedList();

        $list->push('A');
        $list->push('B');

        $this->assertEquals('B', $list->getCurrent());
    }

    public function testFindFail()
    {
        $list = new CircularIndexedList();

        $list->push('A');
        $list->push('B');
        $list->push('C');

        $this->assertFalse($list->find('G'));
    }

    public function testFindPass()
    {
        $list = new CircularIndexedList();

        $list->push('A');
        $list->push('B');
        $list->push('C');

        $this->assertTrue($list->find('B'));
    }

    public function testNextSingle()
    {
        $list = new CircularIndexedList();

        $list->push('A');


        $this->assertEquals('A', $list->getNext());
    }

    public function testNextMultipleMiddle()
    {
        $list = new CircularIndexedList();

        $list->push('A');
        $list->push('B');
        $list->push('C');

        $list->find('B');

        $this->assertEquals('C', $list->getNext());
    }

    public function testNextMultipleLast()
    {
        $list = new CircularIndexedList();

        $list->push('A');
        $list->push('B');
        $list->push('C');


        $this->assertEquals('A', $list->getNext());
    }

    public function testPreviousSingle()
    {
        $list = new CircularIndexedList();

        $list->push('A');


        $this->assertEquals('A', $list->getPrevious());
    }

    public function testPreviousMultipleMiddle()
    {
        $list = new CircularIndexedList();

        $list->push('A');
        $list->push('B');
        $list->push('C');

        $list->find('B');

        $this->assertEquals('A', $list->getPrevious());
    }

    public function testPreviousMultipleFirst()
    {
        $list = new CircularIndexedList();

        $list->push('A');
        $list->push('B');
        $list->push('C');

        $list->find('A');

        $this->assertEquals('C', $list->getPrevious());
    }
}