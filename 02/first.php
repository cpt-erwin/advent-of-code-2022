<?php

declare(strict_types=1);

use App\GameMove;
use App\Strategy;

require_once 'vendor/autoload.php';

const ENEMY_MOVE_INDEX = 0;
const PLAYER_MOVE_INDEX = 1;

function convertLetterToGameMove(string $letter) {
    switch (strtoupper(trim($letter))) {
        case 'A':
        case 'X':
            return GameMove::ROCK;

        case 'B':
        case 'Y':
            return GameMove::PAPER;

        case 'C':
        case 'Z':
            return GameMove::SCISSORS;

        default:
            throw new \UnexpectedValueException($letter);
    }
}

$input = file_get_contents('input');
$inputGames = preg_split("/\n/", $input);

$rounds = [];
foreach ($inputGames as $inputGame) {
    $gameMoves = explode(' ', $inputGame);
    $rounds[] = [
        convertLetterToGameMove($gameMoves[ENEMY_MOVE_INDEX]),
        convertLetterToGameMove($gameMoves[PLAYER_MOVE_INDEX]),
    ];
}

$strategy = new Strategy();
$strategy->load($rounds);

print_r(
    $strategy->getTotalScore()
);
