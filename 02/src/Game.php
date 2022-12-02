<?php

declare(strict_types=1);

namespace App;

use Exception;

class Game
{
    /** @var CircularIndexedList */
    private CircularIndexedList $moveList;

    /**
     * @param GameMove $enemyMove
     * @param GameMove $playerMove
     */
    public function __construct(
        private readonly GameMove $enemyMove,
        private readonly GameMove $playerMove,
    )
    {
        $this->moveList = new CircularIndexedList();
        $this->moveList->push(GameMove::ROCK);
        $this->moveList->push(GameMove::PAPER);
        $this->moveList->push(GameMove::SCISSORS);
    }

    /**
     * @return GameStatus
     * @throws Exception
     */
    public function resolve(): GameStatus
    {
        if ($this->playerMove === $this->enemyMove) {
            return GameStatus::DRAW;
        }

        $this->moveList->find($this->enemyMove);

        if ($this->playerMove === $this->moveList->getNext()) {
            return GameStatus::WIN;
        } else if ($this->playerMove === $this->moveList->getPrevious()) {
            return GameStatus::LOSS;
        } else {
            throw new Exception('Could not resolve game state!');
        }
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getScore(): int
    {
        $status = $this->resolve();

        return $status->getPoints() + $this->playerMove->getPoints();
    }
}