<?php

declare(strict_types=1);

namespace App;

use Exception;

class StringList
{
    /**
     * @param string $content
     */
    public function __construct(
        private readonly string $content
    ) { }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param StringList[] $lists
     *
     * @return string
     * @throws Exception
     */
    public static function compare(array $lists): string
    {
        $data = [];
        foreach ($lists as $list) {
            $data[] = array_unique(str_split($list->getContent()));
        }

        $result = array_values(
            array_intersect(
                ...$data
            )
        );

        $numOfResult = count($result);

        if ($numOfResult === 0) {
            throw new Exception('No result.');
        } elseif ($numOfResult > 1) {
            throw new Exception('Multiple results.');
        }

        return $result[0];
    }

    /**
     * @return StringList[]
     * @throws Exception
     */
    public function splitEqually(): array
    {
        $halfLength = strlen($this->getContent()) / 2;

        if (!is_int($halfLength)) {
            throw new Exception('List length is not even.');
        }

        $lists = str_split(
            $this->getContent(),
            $halfLength
        );

        $data = [];
        foreach ($lists as $list) {
            $data[] = new StringList($list);
        }

        return $data;
    }
}