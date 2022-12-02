<?php

declare(strict_types=1);

use App\CircularIndexedList;
use App\GameMove;
use App\GameStatus;
use App\Strategy;

require_once 'vendor/autoload.php';

const ENEMY_MOVE_INDEX = 0;
const PLAYER_MOVE_INDEX = 1;

function convertLetterToGameMove(string $letter): GameMove {
    switch (strtoupper(trim($letter))) {
        case 'A':
            return GameMove::ROCK;

        case 'B':
            return GameMove::PAPER;

        case 'C':
            return GameMove::SCISSORS;

        default:
            throw new \UnexpectedValueException($letter);
    }
}

function convertLetterToGameStatus(string $letter): GameStatus {
    switch (strtoupper(trim($letter))) {
        case 'X':
            return GameStatus::LOSS;

        case 'Y':
            return GameStatus::DRAW;

        case 'Z':
            return GameStatus::WIN;

        default:
            throw new \UnexpectedValueException($letter);
    }
}

$input = file_get_contents('input');
$inputGames = preg_split("/\n/", $input);

$moveList = new CircularIndexedList();
$moveList->push(GameMove::ROCK);
$moveList->push(GameMove::PAPER);
$moveList->push(GameMove::SCISSORS);

$rounds = [];
foreach ($inputGames as $inputGame) {
    $gameMoves = explode(' ', $inputGame);

    $enemyMove = convertLetterToGameMove($gameMoves[ENEMY_MOVE_INDEX]);
    $gameStatus = convertLetterToGameStatus($gameMoves[PLAYER_MOVE_INDEX]);
    $moveList->find($enemyMove);

    $playerMove = match ($gameStatus) {
        GameStatus::WIN => $moveList->getNext(),
        GameStatus::DRAW => $enemyMove,
        GameStatus::LOSS => $moveList->getPrevious(),
        default => throw new \UnexpectedValueException($gameStatus->name),
    };

    $rounds[] = [
        $enemyMove,
        $playerMove,
    ];
}

$strategy = new Strategy();
$strategy->load($rounds);

print_r(
    $strategy->getTotalScore()
);
