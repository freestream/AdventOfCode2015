<?php
$fp     = fopen('input', 'r');
$paper  = 0;
$ribbon = 0;

while (false !== ($line = fgets($fp))) {
    $lengths = explode('x', trim($line));
    list($l, $w, $h) = $lengths;
    $paper += (2*$l*$w) + (2*$w*$h) + (2*$h*$l) + min(array($l*$w, $w*$h, $h*$l));

    sort($lengths);
    $ribbon += ((array_sum(array_slice($lengths, 0, 2)) * 2) + ($l*$w*$h));
}

echo "The elves need {$paper} square feet of wrapping paper and {$ribbon} feet of ribbon";
