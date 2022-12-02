<?php

declare(strict_types=1);

namespace App;

class Strategy
{
    /** @var Game[] */
    private array $games = [];

    /**
     * @param array[] $rounds
     *
     * @return void
     */
    public function load(array $rounds): void
    {
        foreach ($rounds as $moves) {
            $this->games[] = new Game(
                $moves[0],
                $moves[1]
            );
        }
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getTotalScore(): int
    {
        $total = 0;
        foreach ($this->games as $game) {
            $total += $game->getScore();
        }

        return $total;
    }

    /**
     * @return int
     */
    public function getNumberOfRounds(): int
    {
        return count($this->games);
    }
}