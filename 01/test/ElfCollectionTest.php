<?php

declare(strict_types=1);

namespace Test;

use App\Elf;
use App\ElfCollection;

class ElfCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testSingleAddition(): void
    {
        $elfCollection = new ElfCollection();

        $elf = new Elf();
        $elf->addCalories(1000);

        $elfCollection->add($elf);

        $this->assertEquals(1, $elfCollection->getSize());
    }

    public function testMultipleAddition(): void
    {
        $elfCollection = new ElfCollection();

        $elf1 = new Elf();
        $elfCollection->add($elf1);

        $elf2 = new Elf();
        $elfCollection->add($elf2);

        $elf3 = new Elf();
        $elfCollection->add($elf3);

        $this->assertEquals(3, $elfCollection->getSize());
    }

    public function testRetrievalOfTheMostCalories()
    {
        $elfCollection = new ElfCollection();

        $elf1 = new Elf();
        $elf1->addCalories(1000);
        $elfCollection->add($elf1);

        $elf2 = new Elf();
        $elf2->addCalories(1000);
        $elf2->addCalories(2000);
        $elf2->addCalories(3000);
        $elfCollection->add($elf2);

        $elf3 = new Elf();
        $elf3->addCalories(1000);
        $elf3->addCalories(2000);
        $elfCollection->add($elf3);

        $this->assertEquals(6000, $elfCollection->getMaxCalories());
    }

    public function testRetrievalOfCaloriesSums()
    {
        $elfCollection = new ElfCollection();

        $elf1 = new Elf();
        $elf1->addCalories(1000);
        $elfCollection->add($elf1);

        $elf2 = new Elf();
        $elf2->addCalories(1000);
        $elf2->addCalories(2000);
        $elf2->addCalories(3000);
        $elfCollection->add($elf2);

        $elf3 = new Elf();
        $elf3->addCalories(1000);
        $elf3->addCalories(2000);
        $elfCollection->add($elf3);

        $expectedResult = [
            1000,
            6000,
            3000
        ];

        $difference = array_diff(
            $elfCollection->getCaloriesArray(),
            $expectedResult
        );

        $this->assertEmpty($difference);
    }
}