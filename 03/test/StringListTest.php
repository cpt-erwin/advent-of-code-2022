<?php

declare(strict_types=1);

namespace Test;

use App\StringList;

class StringListTest extends \PHPUnit\Framework\TestCase
{
    public function testCompareOfTwoLists()
    {
        $list1 = new StringList('vJrwpWtwJgWr');
        $list2 = new StringList('hcsFMMfFFhFp');

        $this->assertEquals(
            'p',
            StringList::compare(
                [
                    $list1,
                    $list2
                ]
            )
        );
    }

    public function testSplitEqually()
    {
        $list = new StringList('vJrwpWtwJgWrhcsFMMfFFhFp');
        $lists = $list->splitEqually();

        $this->assertEquals(
            'hcsFMMfFFhFp',
            $lists[1]->getContent()
        );

        $this->assertEquals(
            'vJrwpWtwJgWr',
            $lists[0]->getContent()
        );
    }
}