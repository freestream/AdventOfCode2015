<?php
$fp     = fopen('input', 'r');
$grid   = array();
$sGrid  = array();

while (false !== ($line = fgets($fp))) {
    preg_match('/(on|off|toggle)\s([\d]+),([\d]+)\s\w+\s([\d]+),([\d]+)/', trim($line), $matches);
    list(, $switch, $startX, $startY, $endX, $endY) = $matches;

    for ($y = $startY; $y <= $endY; $y++) {
        for ($x = $startX; $x <= $endX; $x++) {
            if (!isset($sGrid[$y][$x])) {
                $sGrid[$y][$x] = 0;
            }

            switch ($switch) {
                case 'toggle':
                    $sGrid[$y][$x] += 2;
                    if (!isset($grid[$y][$x])) {
                        $grid[$y][$x] = 1;
                    } else {
                        unset($grid[$y][$x]);
                    }
                    break;
                case 'off':
                    $sGrid[$y][$x] = max(0, $sGrid[$y][$x]-1);
                    unset($grid[$y][$x]);
                    break;
                case 'on':
                    $sGrid[$y][$x]++;
                    $grid[$y][$x] = 1;
                    break;
            }
        }
    }
}

$on         = 0;
$brightness = 0;

foreach ($sGrid as $row) {
    $brightness += array_sum($row);
}

foreach ($grid as $row) {
    $on += sizeof($row);
}

echo "On the first try a total of {$on} lights was on but on the second the second attempt to install the lights they all bright with a total of {$brightness}.";

