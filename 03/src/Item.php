<?php

declare(strict_types=1);

namespace App;

class Item
{
    /**
     * @param string $letter
     *
     * @return int
     */
    public static function getPriority(string $letter): int
    {
        $offset = ctype_lower($letter) ? 96 : 64;
        $addition = ctype_upper($letter) ? 26 : 0;

        return (ord($letter) - $offset) + $addition;
    }
}