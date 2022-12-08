<?php

declare(strict_types=1);

namespace App;

class Terminal
{
    private array $context = [];

    private ?Dir $structure = null;

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
            $contextualStructure->addFile(
                new File($record[1], (int)$record[0])
            );
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
     * @return Dir|null
     */
    public function getStructure(): ?Dir
    {
        return $this->structure;
    }

    private function &getStructureFromContext(): Dir
    {
        $structure = &$this->structure;
        foreach ($this->context as $contextDirName) {
            if ($structure === null) {
                $structure = new Dir($contextDirName);
                continue;
            }

            if (!$structure->hasDirByName($contextDirName)) {
                $structure->addDir(
                    new Dir($contextDirName)
                );
            }
            $structure = &$structure->getDirByName($contextDirName);
        }

        return $structure;
    }
}