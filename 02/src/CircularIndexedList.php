<?php

declare(strict_types=1);

namespace App;

class CircularIndexedList
{
    /** @var array */
    private array $list = [];

    /** @var int|null */
    private ?int $index = null;

    /**
     * @param mixed $item
     *
     * @return void
     */
    public function push(mixed $item): void
    {
        $this->list[] = $item;
        $this->index = array_key_last($this->list);
    }

    /**
     * @return mixed
     */
    public function getCurrent(): mixed
    {
        return $this->list[$this->index];
    }

    /**
     * @param mixed $item
     *
     * @return bool
     */
    public function find(mixed $item): bool
    {
        $result = array_search($item, $this->list);
        if ($result === false) {
            return false;
        }

        $this->index = $result;

        return true;
    }

    /**
     * @return mixed
     */
    public function getNext(): mixed
    {
        if ($this->getSize() === 1) {
            return $this->list[$this->index];
        }

        if (($this->index + 1) >= $this->getSize()) {
            return $this->list[array_key_first($this->list)];
        }

        return $this->list[$this->index + 1];
    }

    /**
     * @return int
     */
    public function getSize(): int
    {

        return count($this->list);
    }

    public function getPrevious()
    {
        if ($this->getSize() === 1) {
            return $this->list[$this->index];
        }

        if (($this->index - 1) < 0) {
            return $this->list[array_key_last($this->list)];
        }

        return $this->list[$this->index - 1];
    }
}