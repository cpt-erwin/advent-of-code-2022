<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

/**
 * @param int $row
 * @param int $column
 * @param array $map
 * @param int $maxRowIndex
 * @param int $maxColumnIndex
 *
 * @return int
 */
function getScenicScore(int $row, int $column, array $map, int $maxRowIndex, int $maxColumnIndex): int
{
    $treeSize = $map[$row][$column];
    $score = [0, 0, 0, 0];

    // get score left
    for ($index = $column - 1; $index >= 0; $index--) {
        $score[0]++;
        if ($treeSize <= $map[$row][$index]) {
            break;
        }
    }

    // get score up
    for ($index = $row - 1; $index >= 0; $index--) {
        $score[1]++;
        if ($treeSize <= $map[$index][$column]) {
            break;
        }
    }

    // get score right
    for ($index = $column + 1; $index <= $maxColumnIndex; $index++) {
        $score[2]++;
        if ($treeSize <= $map[$row][$index]) {
            break;
        }
    }

    // get score down
    for ($index = $row + 1; $index <= $maxRowIndex; $index++) {
        $score[3]++;
        if ($treeSize <= $map[$index][$column]) {
            break;
        }
    }

    return $score[0] * $score[1] * $score[2] * $score[3];
}

$input = file_get_contents('input');

$map = [];
foreach (preg_split("/\n/", $input) as $columns) {
    $mapData = [];
    foreach (str_split(trim($columns)) as $column) {
        $mapData[] = (int)$column;
    }
    $map[] = $mapData;
}

$maxRowIndex = count($map) - 1;
$maxColumnIndex = count($map[0]) - 1;
$maxScenicScore = 0;

foreach ($map as $row => $columns) {
    foreach ($columns as $column => $treeSize) {
        $scenicScore = getScenicScore($row, $column, $map, $maxRowIndex, $maxColumnIndex);
        if ($scenicScore > $maxScenicScore) {
            $maxScenicScore = $scenicScore;
        }
    }
}

print_r($maxScenicScore);