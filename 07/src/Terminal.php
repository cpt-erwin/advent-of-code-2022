<?php

declare(strict_types=1);

namespace App;

class Terminal
{
    private array $context = [];

    public function cd(string $dirName): void
    {
        if ($dirName === '..') {
            array_pop($this->context);
        } else {
            $this->context[] = $dirName;
        }
    }

    /**
     * @param string[] $structure
     *
     * @return Dir[]|File[]
     */
    public function ls(array $structure): array
    {
        $result = [];
        foreach ($structure as $item) {
            $record = explode(' ', $item);
            if ($record[0] === 'dir') {
                $result[] = new Dir($record[1]);
                continue;
            }
            $result[] = new File($record[1], (int)$record[0]);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}