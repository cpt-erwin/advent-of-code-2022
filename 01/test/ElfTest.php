<?php

declare(strict_types=1);

namespace Test;

use App\Elf;

class ElfTest extends \PHPUnit\Framework\TestCase
{
    public function testSingleCalories() {
        $elf = new Elf();
        $elf->addCalories(1000);
        $this->assertEquals(1000, $elf->getCaloriesTotal());
    }

    public function testMultipleCalories() {
        $elf = new Elf();
        $elf->addCalories(1000);
        $elf->addCalories(2000);
        $elf->addCalories(3000);
        $this->assertEquals(6000, $elf->getCaloriesTotal());
    }

    public function testRandomCalories() {
        $elf = new Elf();
        $calories = random_int(0, PHP_INT_MAX);
        $elf->addCalories($calories);
        $this->assertEquals($calories, $elf->getCaloriesTotal());
    }
}