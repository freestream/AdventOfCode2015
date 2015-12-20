<?php
$fp             = fopen('input', 'r');
$containers     = array();
$combinations   = array();
$liters         = 150;

while (false !== ($line = fgets($fp))) {
    $value = intval(trim($line));
    $containers[] = $value;
}

$count = count($containers);
$total = pow(2, $count);

for ($i = 0; $i < $total; $i++) {
    $tmp = array();

    for ($j = 0; $j < $count; $j++) {
        if (pow(2, $j) & $i) {
            $tmp[] = (int) $containers[$j];
        }
    }

    if (array_sum($tmp) == $liters) {
        $combinations[] = $tmp;
    }
}

$counts = array();

foreach ($combinations as $id => $combination) {
    $counts[$id] = count($combination);
}

$counts = array_count_values($counts);
ksort($counts);

$a = count($combinations);
$b = array_shift($counts);

echo "The total amount of combinations is {$a} and the combination with minium combination uses {$b} containers.";

