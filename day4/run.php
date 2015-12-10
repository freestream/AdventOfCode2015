<?php
$secret     = '';
$results    = array();
$goals      = array(5, 6);

foreach ($goals as $goal) {
    $i = 0;
    do {
        $i++;
    } while (!preg_match('/^[0]{' . $goal . '}/', md5("{$secret}{$i}")));

    $results[$goal] = $i;
}

$results = implode(' and ', $results);
echo "The puzzle answers is {$results}.";

