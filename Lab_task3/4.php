<?php

function Largest($num1,$num2,$num3) {
    if ($num1 >= $num2 && $num1 >= $num3) {
        echo "$num1 is the largest number.";
    } elseif ($num2 >= $num1 && $num2 >= $num3) {
        echo "$num2 is the largest number.";
    } else {
        echo "$num3 is the largest number.";
    }
}


$num1 = 150;
$num2 = 300;
$num3 = 250;

echo "The numbers are: <br> $num1 <br> $num2 <br> $num3 <br>";
Largest($num1, $num2, $num3);
?>