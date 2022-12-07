<?php

declare(strict_types=1);

namespace App;

class File
{
    /**
     * @param string $name
     * @param int $size
     */
    public function __construct(
        readonly protected string $name,
        readonly protected int    $size
    )
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
}