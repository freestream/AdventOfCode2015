<?php
$fp             = fopen('input', 'r');
$ingredients    = array();

while (false !== ($line = fgets($fp))) {
    preg_match('/^(\w+):\s(\w+)\s([\d-]+),\s(\w+)\s([\d-]+),\s(\w+)\s([\d-]+),\s(\w+)\s([\d-]+),\s(\w+)\s([\d-]+)/', trim($line), $matches);
    list(,$a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k) = $matches;

    $ingredients[$a] = array(
        $b  => intval($c),
        $d  => intval($e),
        $f  => intval($g),
        $h  => intval($i),
        $j  => intval($k),
    );
}

$sugar      = $ingredients['Sugar'];
$sprinkles  = $ingredients['Sprinkles'];
$candy      = $ingredients['Candy'];
$chocolate  = $ingredients['Chocolate'];
$properties = array('capacity', 'durability', 'flavor', 'texture');

$score      = 0;
$calScore   = 0;

for ($s = 0; $s <= 100; $s++) {
    for ($p = 0; $p <= 100 - $s; $p++) {
        for ($c = 0; $c <= 100 - ($s - $p); $c++) {
            for ($h = 0; $h <= 100 - ($s - $p - $c); $h++) {
                if (($s + $p + $c + $h) != 100) {
                    continue;
                }

                $result = array();

                foreach ($properties as $propertie) {
                    $sum = array_sum(array(
                        $s * $sugar[$propertie],
                        $p * $sprinkles[$propertie],
                        $c * $candy[$propertie],
                        $h * $chocolate[$propertie],
                    ));

                    $result[$propertie] = max(0, $sum);
                }

               $cal = array_sum(array(
                    $s * $sugar['calories'],
                    $p * $sprinkles['calories'],
                    $c * $candy['calories'],
                    $h * $chocolate['calories'],
                ));

                $score = max($score, array_product($result));

                if ($cal == 500) {
                    $calScore = max($calScore, array_product($result));
                }
            }
        }
    }
}

echo "The total score of the highest-scoring cookie is {$score} and with a max of 500 calorie the  highest-scoring cookie is {$calScore}";

