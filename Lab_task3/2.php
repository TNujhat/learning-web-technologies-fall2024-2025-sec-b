<?php

function calculateVAT($amount) { 
    $vat = $amount * 0.15;
    return $vat;
}

$amount = 1000; 
$vat = calculateVAT($amount);
$totalAmount = $amount + $vat;

echo "Original Amount: $" . number_format($amount, 2) . "<br>";
echo "VAT (15%): $" . number_format($vat, 2) . "<br>";
echo "Total Amount: $" . number_format($totalAmount, 2) . "<br>";
?>