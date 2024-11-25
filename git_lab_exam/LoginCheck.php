<?php
session_start();


if (isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "Please enter both email and password!";
    } else {
     
        if ($email === 'test@example.com' && $password === 'password123') {
            
            $_SESSION['xyz'] = true;          
            $_SESSION['email'] = $email;     
            header('Location: home.php');
            exit();
        } else {
            echo "Invalid email or password!";
        }
    }
} else {

    header('Location: login.html');
    exit();
}
?>
