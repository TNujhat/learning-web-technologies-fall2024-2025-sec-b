<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

   
    $errorMessages = [];

    if (empty($day) || $day < 1 || $day > 31) {
        $errorMessages[] = "Day should be a number between 1 and 31.";
    }


    if (empty($year) || $year < 1953 || $year > 1998) {
        $errorMessages[] = "Year must be between 1953 and 1998.";
    }


    if (empty($month) || $month < 1 || $month > 12) {
        $errorMessages[] = "Month must be between 1 and 12.";
    }

    if (count($errorMessages) === 0) {
        echo "Your Date of Birth is: $day/$month/$year";
    } else {
        echo "The following issues were found with your submission:<br>";
        foreach ($errorMessages as $message) {
            echo "- $message<br>";
        }
    }

} else {
    echo "Please submit the form to check your Date of Birth.";
}
?>
