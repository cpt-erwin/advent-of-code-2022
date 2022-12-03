<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Item;
use App\StringList;

$input = file_get_contents('input');
$inputLists = preg_split("/\n/", $input);

$sum = 0;
$lists = [];
foreach ($inputLists as $inputList) {
    $list = new StringList(trim($inputList));
    $lists[] = $list;

    $halfLists = $list->splitEqually();

    $resultLetter = StringList::compare($halfLists);
    $resultPriority = Item::getPriority($resultLetter);

    $sum += $resultPriority;
}

print_r($sum);