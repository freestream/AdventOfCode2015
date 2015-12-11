<?php
$fp         = fopen('input', 'r');
$nice       = array();
$retrospect = array();

while (false !== ($line = fgets($fp))) {
    $line       = trim($line);
    $letters    = str_split($line);
    $passes     = 0;

    $vowelsCount = array_sum(array_intersect_key(
        array_count_values($letters),
        array_intersect_key(array_flip($letters), array_flip(str_split('aeiou')))
    ));

    if ($vowelsCount >= 3) {
        $passes++;
    }

    if (preg_match('/(.)\1/', $line)) {
        $passes++;
    }

    if (preg_match('/((ab)|(cd)|(pq)|(xy))/', $line)) {
        $passes = 0;
    }

    if ($passes == 2) {
        $nice[] = $line;
    }

    $passes = 0;

    for ($i = 0; $i <= strlen($line); $i++) {
        if (!isset($letters[$i+2])) {
            continue;
        }

        if ($letters[$i] == $letters[$i+2]) {
            $passes++;
            break;
        }
    }

    for ($i = 0; $i <= strlen($line); $i++) {
        $find       = substr($line, $i, 2);
        $remaining  = substr($line, $i+2);

        if (strlen($find) < 2 || strlen($remaining) < 2) {
            break;
        }

        if (strpos($remaining, $find) !== false) {
            $passes++;
            break;
        }
    }

    if ($passes == 2) {
        $retrospect[] = $line;
    }
}

$r = count($retrospect);
$s = count($nice);

echo "Santa figuring out that {$s} strings was nice but after realizing the error his error he got it down to {$r} nice strings.";
