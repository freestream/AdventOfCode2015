<?php
$fp         = fopen('input', 'r');
$floor      = 0;
$chars      = 1;
$baseChar   = null;

while (false !== ($char = fgetc($fp))) {
    switch ($char) {
        case '(':
            $floor++;
            break;
        case ')':
            $floor--;
            break;
    }

    if ($floor == -1 && $baseChar === null) {
        $baseChar = $chars;
    }

    if ($baseChar === null) {
        $chars++;
    }
}

echo "Deliver presents to floor {$floor} and Santa enter the basement at character {$baseChar}";
