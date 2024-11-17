<?php
$elements = array("apple", "banana", "cherry", "date");

$search = "cherry";

foreach ($elements as $element) {
    if ($element === $search) {
        echo "Element '$search' is found in the array.";
        exit;
    }
}
    echo "Element '$search' is not found in the array.";

?>