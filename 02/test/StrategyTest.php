<?php

declare(strict_types=1);

namespace Test;

use App\Strategy;
use App\GameMove;

class StrategyTest extends \PHPUnit\Framework\TestCase
{
    public function testLoad()
    {
        $strategy = new Strategy();

        $strategy->load(
            [
                [GameMove::ROCK, GameMove::PAPER],
                [GameMove::SCISSORS, GameMove::SCISSORS],
                [GameMove::PAPER, GameMove::ROCK]
            ]
        );

        $this->assertEquals(3, $strategy->getNumberOfRounds());
    }

    public function testTotalScore()
    {
        $strategy = new Strategy();

        $strategy->load(
            [
                [GameMove::ROCK, GameMove::PAPER], // 6 + 2 = 8
                [GameMove::SCISSORS, GameMove::SCISSORS], // 3 + 3 = 6 (+ 8 = 14)
                [GameMove::PAPER, GameMove::ROCK] // 0 + 1 = 1 (+ 14 = 15)
            ]
        );

        $this->assertEquals(15, $strategy->getTotalScore());
    }
}