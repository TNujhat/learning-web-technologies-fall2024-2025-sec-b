<?php 
if (isset($_POST['submit'])) {
    $username = $_POST['username']; 

    if ($username == null) {
        echo "<h3>Null username</h3>";
    } 
    elseif (!preg_match('/^[a-zA-Z][a-zA-Z .-]*$/', $username)) {
        echo "<h3>Username must start with a letter and can only contain letters, periods, and dashes.</h3>";
    } 
    elseif (str_word_count($username) < 2) {
        echo "<h3>Username must contain at least two words.</h3>";
    } 
    else {
        echo "<h3>Valid username: $username</h3>";
    }
} 
?>
