<?php

declare(strict_types=1);

namespace App;

class Marker
{
    /**
     * @param string $context
     * @param string $content
     * @param int $offset
     */
    public function __construct(
        readonly string $context,
        readonly string $content,
        readonly int $offset
    ) { }

    /**
     * @param string $content
     * @param int $length
     *
     * @return Marker|null
     */
    public static function createFromString(string $content, int $length): ?Marker
    {
        for ($i = 0; $i < strlen($content) - $length; $i++) {
            $testSample = substr($content, $i, $length);
            if (count(array_unique(str_split($testSample))) === strlen($testSample)) {
                return new Marker(
                    $content,
                    $testSample,
                    $i
                );
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}