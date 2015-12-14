<?php
$first  = 0;
$second = 0;

foreach (file('input', FILE_IGNORE_NEW_LINES) as $line) {
    eval('$str = ' . $line . ';');
    $first += strlen($line) - strlen($str);
    $second += strlen(addslashes($line))+2-strlen($line);
}

echo "In the first run it was {$first} number of characters of code and in the seocnd it was {$second}.";

