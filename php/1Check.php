<?php
session_start();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    
    
    if ($username == null) {
        echo "<h1>Null username/password</h1>";
    }
    
    elseif (!preg_match('/^[a-zA-Z][a-zA-Z .-]*$/', $username)) {
        echo "<h1>Username must start with a letter and can only contain letters, periods, and dashes.</h1>";
    }
    
    elseif (str_word_count($username) < 2) {
        echo "<h1>Username must contain at least two words.</h1>";
    }
    
    else {
        echo $username;
    }
}
?>