<?php

declare(strict_types=1);

namespace App;

class ElfCollection
{
    /** @var Elf[] */
    private array $collection;

    public function __construct()
    {
        $this->collection = [];
    }

    public function add(Elf $elf): void
    {
        $this->collection[] = $elf;
    }

    public function getSize(): int
    {
        return count($this->collection);
    }

    public function getMaxCalories(): int
    {
        $maxCalories = 0;
        foreach ($this->collection as $elf) {
            if ($elf->getCaloriesTotal() > $maxCalories) {
                $maxCalories = $elf->getCaloriesTotal();
            }
        }

        return $maxCalories;
    }

    public function getCaloriesArray(): array
    {
        $data = [];
        foreach ($this->collection as $elf) {
            $data[] = $elf->getCaloriesTotal();
        }

        return $data;
    }
}