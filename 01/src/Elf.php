<?php

declare(strict_types=1);

namespace App;

class Elf
{
    /** @var int[] */
    private array $calories;

    public function __construct()
    {
        $this->calories = [];
    }

    public function addCalories(int $calories)
    {
        $this->calories[] = $calories;
    }

    public function getCaloriesTotal(): int
    {
        return array_sum($this->calories);
    }
}