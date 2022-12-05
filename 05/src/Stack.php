<?php

declare(strict_types=1);

namespace App;

use Exception;

class Stack
{
    /** @var string[] */
    private array $items = [];

    /**
     * @param string ...$items
     *
     * @return void
     */
    public function push(string ...$items): void
    {
        array_push($this->items, ...$items);
    }

    /**
     * @param int $numberOfItems
     *
     * @return Stack
     * @throws Exception
     */
    public function pop(int $numberOfItems): Stack
    {
        if ($numberOfItems > count($this->items)) {
            throw new Exception('Requested pop for more elements than are in stack.');
        }

        $stack = new Stack();
        for ($i = 0; $i < $numberOfItems; $i++) {
            $stack->push(
                array_pop($this->items)
            );
        }

        return $stack;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return count($this->items);
    }
}