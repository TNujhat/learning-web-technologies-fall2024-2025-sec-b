<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "<p style='color:red;'>Both fields are required.</p>";
        exit();
    }

    $conn = new mysqli('localhost', 'root', '', 'brta management');
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();

    if ($password && $password === $password) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../View/user_dashboard.php"); 
        exit();

        echo "<p style='color:red;'>Invalid username or password.</p>";
    }


    $stmt->close();
    $conn->close();

}
?>
