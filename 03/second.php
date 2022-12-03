<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Item;
use App\StringList;

$input = file_get_contents('input');
$inputLists = preg_split("/\n/", $input);

$lists = [];
foreach ($inputLists as $inputList) {
    $lists[] = new StringList(trim($inputList));
}

$sum = 0;

$listBatches = array_chunk($lists, 3);
foreach ($listBatches as $listBatch) {
    $resultLetter = StringList::compare($listBatch);
    $resultPriority = Item::getPriority($resultLetter);
    $sum += $resultPriority;
}

print_r($sum);