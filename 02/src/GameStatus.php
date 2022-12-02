<?php

declare(strict_types=1);

namespace App;

enum GameStatus
{
    case WIN;
    case DRAW;
    case LOSS;

    public function getPoints(): int
    {
        return match ($this) {
            GameStatus::WIN => 6,
            GameStatus::DRAW => 3,
            GameStatus::LOSS => 0,
        };
    }
}