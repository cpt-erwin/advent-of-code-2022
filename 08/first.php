<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

/**
 * @param array $rows
 *
 * @return void
 */
function displayMatrix(array $rows): void
{
    foreach ($rows as $columns) {
        foreach ($columns as $column) {
            echo (int)$column . " ";
        }
        echo PHP_EOL;
    }
}

/**
 * @param array $matrix
 *
 * @return void
 */
function rotateMatrix(array &$matrix): void
{
    $rotatedMatrix = [];
    for ($column = 0; $column < count($matrix[0]); $column++) {
        $rotatedMatrixRow = [];
        for ($row = count($matrix) - 1; $row >= 0; $row--) {
            $rotatedMatrixRow[] = $matrix[$row][$column];
        }
        $rotatedMatrix[] = $rotatedMatrixRow;
    }

    $matrix = $rotatedMatrix;
}


$input = file_get_contents('input');

$visibleTreesMap = [];
$map = [];
foreach (preg_split("/\n/", $input) as $columns) {
    $mapData = [];
    $visibleTreesMapData = [];
    foreach (str_split(trim($columns)) as $column) {
        $mapData[] = $column;
        $visibleTreesMapData[] = false;
    }
    $map[] = $mapData;
    $visibleTreesMap[] = $visibleTreesMapData;
}

for ($i = 0; $i < 4; $i++) {
    foreach ($map as $row => $columns) {
        $previousTreeSize = -1;
        foreach ($columns as $column => $treeSize) {
            if ($treeSize > $previousTreeSize) {
                $visibleTreesMap[$row][$column] = true;
                $previousTreeSize = $treeSize;
            }
        }
    }
    rotateMatrix($map);
    rotateMatrix($visibleTreesMap);
}


displayMatrix($map);
echo PHP_EOL;
displayMatrix($visibleTreesMap);
echo PHP_EOL;

$numOfVisibleTrees = 0;
foreach ($visibleTreesMap as $row => $columns) {
    foreach ($columns as $column => $treeVisibility) {
        if ($treeVisibility) {
            $numOfVisibleTrees++;
        }
    }
}

print_r($numOfVisibleTrees);


