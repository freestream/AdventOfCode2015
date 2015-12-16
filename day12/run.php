<?php
$content    = file_get_contents('input');
$data       = json_decode($content);

function getSumOfNumbers($array, $ignoreRed = false)
{
    $total = 0;

    foreach ($array as $val) {
        if (is_object($val)) {
            $hasRed = false;
            foreach ($val as $v) {
                $hasRed = ($v === 'red') ? true : $hasRed;
            }
            $total += ($hasRed == true && $ignoreRed == true) ? 0 : getSumOfNumbers($val, $ignoreRed);
        } elseif (is_array($val)) {
            $total += getSumOfNumbers($val, $ignoreRed);
        } elseif (is_numeric($val)) {
            $total += $val;
        }
    }

    return $total;
}

$a = getSumOfNumbers($data);
$b = getSumOfNumbers($data, true);

echo "The sum of all numbers in the documents is {$a} but if you disrecard miscount red´s the total will be {$b}";


