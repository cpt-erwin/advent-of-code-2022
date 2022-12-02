<?php

declare(strict_types=1);

namespace App;

class Round
{
    /**
     * @param GameMove $enemyMove
     * @param GameMove $playerMove
     */
    public function __construct(
        private readonly GameMove $enemyMove,
        private readonly GameMove $playerMove,
    ) {}

    public function getScore(): int
    {
        return Game::resolve(
            $this->enemyMove,
            $this->playerMove,
        );
    }
}