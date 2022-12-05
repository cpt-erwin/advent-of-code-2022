<?php

declare(strict_types=1);

use App\Stack;

require_once 'vendor/autoload.php';

$input = file_get_contents('input');
$inputs = preg_split("#\n\s*\n#Uis", $input);

$cargoMapRows = preg_split("/\n/", $inputs[0]);
array_pop($cargoMapRows);
$cargoMapRows = array_reverse($cargoMapRows);
$cargoStacks = [];
foreach ($cargoMapRows as $cargoMapRow) {
    $cargoColumns = str_split($cargoMapRow, 4);
    foreach ($cargoColumns as $index => $cargoColumn) {
        $cargoColumn = str_replace(['[', ']'], '', trim($cargoColumn));
        if (!empty($cargoColumn)) {
            if (!array_key_exists($index, $cargoStacks)) {
                $cargoStacks[$index] = new Stack();
            }
            $cargoStacks[$index]->push($cargoColumn);
        }
    }
}

$instructions = preg_split("/\n/", $inputs[1]);
foreach ($instructions as $instruction) {
    preg_match_all('!\d+!', $instruction, $matches);
    $matches = $matches[0];
    if (count($matches) === 3) {
        $numOfItems = (int)$matches[0];
        $firstStackIndex = (int)$matches[1] - 1;
        $secondStackIndex = (int)$matches[2] - 1;

        $poppedItems = $cargoStacks[$firstStackIndex]->pop(
            $numOfItems
        )->getItems();

        $cargoStacks[$secondStackIndex]->push(
            ...$poppedItems
        );
    }
}

foreach ($cargoStacks as $cargoStack) {
    print_r($cargoStack->pop(1)->getItems()[0]);
}

