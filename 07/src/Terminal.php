<?php

declare(strict_types=1);

namespace App;

class Terminal
{
    private array $context = [];

    private array $structure = [];

    public function cd(string $dirName): void
    {
        if ($dirName === '..') {
            array_pop($this->context);
        } else {
            $this->context[] = $dirName;
        }

        $this->getStructureFromContext();
    }

    /**
     * @param string[] $structure
     *
     * @return void
     */
    public function ls(array $structure): void
    {
        $contextualStructure = &$this->getStructureFromContext();
        foreach ($structure as $item) {
            $record = explode(' ', $item);
            if ($record[0] === 'dir') {
                continue;
            }
            $contextualStructure[] = new File($record[1], (int)$record[0]);
        }
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @return array
     */
    public function getStructure(): array
    {
        return $this->structure;
    }

    private function &getStructureFromContext(): array
    {
        $structure = &$this->structure;
        foreach ($this->context as $contextDirName) {
            if (empty($structure)) {
                $structure[$contextDirName] = [];
                continue;
            }

            if (!array_key_exists($contextDirName, $structure)) {
                $structure[$contextDirName] = [];
            }
            $structure = &$structure[$contextDirName];
        }

        return $structure;
    }
}