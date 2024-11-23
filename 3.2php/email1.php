<?php
session_start();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']); 

    if ($email == null) {
        echo "<h3>Null email</h3>"; 
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h3>Must be a valid email address (e.g., anything@example.com)</h3>";
    } 
    else {
        echo "<h3>Email is valid!</h3>";
    }
}
?>

