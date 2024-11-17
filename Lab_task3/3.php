<?php

function odd_even($number) {
    if ($number % 2 == 0) {
        echo "The number is even";
    }
    else{
        echo "The number is odd";
    }
    }

$number=15;
echo "The number is: $number  <br>";
odd_even($number);
?>