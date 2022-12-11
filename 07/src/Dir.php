<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Util\Exception;

class Dir
{
    /**
     * @var Dir[]|File[]
     */
    protected array $content = [];

    /**
     * @var Dir[]
     */
    protected array $dirs = [];

    /**
     * @var File[]
     */
    protected array $files = [];

    /**
     * @param string $name
     */
    public function __construct(
        readonly protected string $name,
    )
    {
    }

    /**
     * @param Dir $dir
     *
     * @return void
     */
    public function addDir(Dir $dir): void
    {
        if (array_key_exists($dir->getName(), $this->dirs)) {
            throw new Exception('Unique filename violation!');
        }

        $this->dirs[$dir->getName()] = $dir;
        $this->content[] = $dir;
    }

    /**
     * @param File $file
     *
     * @return void
     */
    public function addFile(File $file): void
    {
        if (array_key_exists($file->getName(), $this->files)) {
            throw new Exception('Unique filename violation!');
        }

        $this->files[$file->getName()] = $file;
        $this->content[] = $file;
    }

    /**
     * @return Dir[]|File[]
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param bool $recursively
     *
     * @return Dir[]
     */
    public function getDirs(bool $recursively): array
    {
        if (!$recursively) {
            return $this->dirs;
        }

        $dirs = [$this->dirs];
        foreach ($this->dirs as $dir) {
            $dirs[] = $dir->getDirs(true);
        }

        return array_merge(...$dirs);
    }

    /**
     * @return File[]
     */
    public function getFiles(): array
    {
        return $this->files;
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
        $size = 0;
        foreach ($this->content as $item) {
            $size += $item->getSize();
        }
        return $size;
    }
}