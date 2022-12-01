<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

$elfList = file_get_contents('../input');
$elfListBatches = preg_split("/\n\r\n/", $elfList);

$elfCollection = new \App\ElfCollection();

foreach ($elfListBatches as $batch) {
    $elf = new \App\Elf();
    $caloriesList = preg_split("/\n/", $batch);
    foreach ($caloriesList as $calories) {
        $elf->addCalories((int)$calories);
    }
    $elfCollection->add($elf);
}

print_r('Size: ' . $elfCollection->getSize());
print_r(PHP_EOL);
print_r('Max calories: ' . $elfCollection->getMaxCalories());
print_r(PHP_EOL);

$caloriesArray = $elfCollection->getCaloriesArray();
rsort($caloriesArray);
$topThree = array_slice($caloriesArray, 0, 3);
print_r($topThree);

print_r('Top 3 calories' . PHP_EOL . '----------' . PHP_EOL);
print_r(array_sum($topThree));
