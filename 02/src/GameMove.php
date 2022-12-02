<?php

declare(strict_types=1);

namespace App;

enum GameMove
{
    case ROCK;
    case PAPER;
    case SCISSORS;

    public function getPoints(): int
    {
        return match ($this) {
            GameMove::ROCK => 1,
            GameMove::PAPER => 2,
            GameMove::SCISSORS => 3,
        };
    }
}