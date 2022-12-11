<?php

declare(strict_types=1);

namespace App;

class Terminal
{
    private array $context = [];

    protected Filesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }


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
     * @return void
     */
    public function ls(array $structure): void
    {
        foreach ($structure as $item) {
            $record = explode(' ', $item);
            $contextualDir = $this->filesystem->getDirFromContext($this->context);
            if ($record[0] === 'dir') {
                $contextualDir->addDir(
                    $this->filesystem->getDirFromContext(
                        array_merge($this->context, [$record[1]])
                    )
                );
            } else {
                $contextualDir->addFile(
                    new File($record[1], (int)$record[0])
                );
            }
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
     * @return Filesystem
     */
    public function getFilesystem(): Filesystem
    {
        return $this->filesystem;
    }
}