<?php

declare(strict_types=1);

namespace App;

class Filesystem
{
    /** @var Dir[]  */
    private array $directories = [];

    public function getDirFromContext(array $context): Dir
    {
        $directoryKey = implode('\\', $context);
        if (!array_key_exists($directoryKey, $this->directories)){
            $dir = new Dir(array_pop($context));
            $this->directories[$directoryKey] = &$dir;
        }

        return $this->directories[$directoryKey];
    }

    /**
     * @return Dir[]
     */
    public function getDirectories(): array
    {
        return $this->directories;
    }
}