<?php
$num = '1';

function getLookAndSayFrom($num, $times) {
    foreach(range(1, $times) as $i) {
        $num = preg_replace_callback('#(.)\1*#', function($matches) {
                return strlen($matches[0]).$matches[1];
            },
            $num
        );
    }

    return $num;
}

$a = strlen(getLookAndSayFrom($num, 40));
$b = strlen(getLookAndSayFrom($num, 50));

echo "After 40 times the length is {$a} and efter 50 times the length grew to {$b}";

