<?php

declare(strict_types=1);

namespace Test;

use App\Game;
use App\GameMove;
use App\GameStatus;

class GameTest extends \PHPUnit\Framework\TestCase
{
    public function testWin()
    {
        $game = new Game(
            GameMove::ROCK,
            GameMove::PAPER
        );

        $this->assertEquals(
            GameStatus::WIN,
            $game->resolve()
        );
    }

    public function testDraw()
    {
        $game = new Game(
            GameMove::SCISSORS,
            GameMove::SCISSORS
        );

        $this->assertEquals(
            GameStatus::DRAW,
            $game->resolve()
        );
    }

    public function testLoss()
    {
        $game = new Game(
            GameMove::PAPER,
            GameMove::ROCK
        );

        $this->assertEquals(
            GameStatus::LOSS,
            $game->resolve()
        );
    }



    public function testScore()
    {
        $game = new Game(
            GameMove::PAPER,
            GameMove::ROCK
        );

        $this->assertGreaterThan(
            GameStatus::LOSS->getPoints(),
            $game->getScore()
        );
    }
}